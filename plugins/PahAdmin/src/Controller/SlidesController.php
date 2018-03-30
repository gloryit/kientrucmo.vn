<?php

namespace PahAdmin\Controller;

use App\Controller\API\StringAPI;
use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;

/**
 * Class SlidesController
 * @property \App\Model\Table\SlidesTable $Slides
 * @package PahAdmin\Controller
 */
class SlidesController extends AdminController
{

    public function initialize() {
        parent::initialize();
        $this->loadModel('Slides');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {}

    public function datatables()
    {
        $this->response = $this->response->withHeader('Content-Type', 'application/json');

        $params = $this->_parse_datatables_params();

        /** @var \App\Model\Entity\Slide[] $slides */
        $slides_query = $this->Slides->find();

        $params['recordsFiltered'] = $params['recordsTotal'] = $slides_query->count();

        $slides_query->orderDesc('created')
            ->select([
                'id',
                'uri',
                'slug',
                'title',
                'created'
            ])
            ->where([
                'title LIKE' => '%' . $params['keyword'] . '%',
                'delete_flag' => 0
            ])
            ->limit($params['length'])
            ->offset($params['start']);

        $slides = $slides_query->toArray();

        $params['data'] = $slides;

        $this->response = $this->response->withStringBody(json_encode($params));
        return $this->response;
    }

    public function delete()
    {
        $this->response = $this->response->withType('application/json');
        if ($this->request->is(['post', 'delete'])) {
            $id = $this->request->getData('id');
            /** @var \App\Model\Entity\Slide $slide */
            $slide = $this->Slides->find()
                ->where(['id' => intval($id)])
                ->firstOrFail();

            $slide->delete_flag = 1;

            if ($this->Slides->save($slide)) {
                $this->response = $this->response->withStringBody(json_encode([
                    'status' => 200
                ]));

                return $this->response;
            }
        }

        $this->response = $this->response->withStringBody(json_encode([
            'status' => 201,
            'message' => 'Invalid request'
        ]));

        return $this->response;
    }

    public function edit($id = null)
    {
        /** @var \App\Model\Entity\Slide $slide */
        if ($id) {
            $slide = $this->Slides->find()
                ->where([
                    'id' => $id
                ])
                ->firstOrFail();
        } else {
            $slide = $this->Slides->newEntity();
        }

        $this->set(compact('slide'));

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            $validator = new Validator();

            $validator
                ->requirePresence('is_active')
                ->notEmpty('is_active')
                ->requirePresence('image_uri')
                ->notEmpty('image_uri')
                ->requirePresence('title')
                ->allowEmpty('title');

            $errors = $validator->errors($this->request->getData());

            if ($errors) {
                throw new NotFoundException('Invalid request!');
            }

            $slide->uri = $data['image_uri'];
            $slide->title = $data['title'];
            $slide->slug = StringAPI::convertToAscii($data['title']);
            $slide->is_active = $data['is_active'];

            if ($this->Slides->save($slide)) {
                $this->Flash->success(__('The user has been saved.'), ['key' => 'posts_key']);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'), ['key' => 'posts_key']);
        }
    }

    /**
     * @return array
     */
    protected function _parse_datatables_params()
    {
        $params = array(
            'start' => floor($this->request->getQuery('start')),
            'length' => floor($this->request->getQuery('length')),
            'draw' => floor($this->request->getQuery('draw')),
        );

        if ($params['length'] > 200) {
            $params['length'] = 50;
        }

        $search = $this->request->getQuery('search'); //value: value search, regex: true/false
        $order = $this->request->getQuery('order');

        $params['direction'] = $params['column_ordered'] = false;
        if ($order && isset($order[0])) {
            if (isset($order[0]['column'])) {
                $params['column_ordered'] = $order[0]['column']; // Direction, not need to validate
            }

            if (isset($order[0]['dir'])) {
                $params['direction'] = $order[0]['dir']; // Direction, not need to validate
            }
        };

        $params['keyword'] = false;
        if (isset($search['value']) && $search['value'] != "" && strlen($search['value']) < 250) {
            $params['keyword'] = $search['value'];
        };

        return $params;
    }
}
