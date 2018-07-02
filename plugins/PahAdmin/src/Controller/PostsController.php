<?php
/**
 * Created by IntelliJ IDEA.
 * User: zeref
 * Date: 8/23/17
 * Time: 11:39 AM
 */

namespace PahAdmin\Controller;

use App\Controller\API\StringAPI;
use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;

/**
 * Class PostsController
 * @package PahAdmin\Controller
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AdminController
{

    public $flash_error_key = 'fadfadfdsaf';

    /**
     * @return void
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     * @throws \Cake\Datasource\Exception\MissingModelException
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Posts');
    }

    public function index(){}

    public function datatables()
    {
        $this->response = $this->response->withHeader('Content-Type', 'application/json');

        $params = $this->_parse_datatables_params();

        /** @var \App\Model\Entity\Post[] $posts */
        $posts_query = $this->Posts->find();

        $params['recordsFiltered'] = $params['recordsTotal'] = $posts_query->count();

        $posts_query->orderDesc('created')
            ->where([
                'title LIKE' => '%' . $params['keyword'] . '%',
            ])
            ->limit($params['length'])
            ->offset($params['start']);

        $posts = $posts_query->toArray();

        $params['data'] = $posts;

        $this->response = $this->response->withStringBody(json_encode($params));
        return $this->response;
    }

    public function delete()
    {
        $this->response = $this->response->withType('application/json');
        if ($this->request->is(['post', 'delete'])) {
            $id = $this->request->getData('id');
            /** @var \App\Model\Entity\Post $posts */
            $posts = $this->Posts->find()
                ->where(['id' => intval($id)])
                ->firstOrFail();

            if ($this->Posts->delete($posts)) {
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
        /** @var \App\Model\Entity\Post $posts */
        if ($id) {
            $posts = $this->Posts->find()
                ->where([
                    'id' => $id
                ])
                ->firstOrFail();
        } else {
            $posts = $this->Posts->newEntity();
        }
        $this->set(compact('posts'));

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            $validator = new Validator();

            $validator
                ->requirePresence('menu_id')
                ->notEmpty('menu_id')
                ->requirePresence('is_active')
                ->notEmpty('is_active')
                ->requirePresence('dsp_order')
                ->notEmpty('dsp_order')
                ->requirePresence('image_uri')
                ->notEmpty('image_uri')
                ->requirePresence('title')
                ->allowEmpty('title')
                ->requirePresence('header')
                ->allowEmpty('header')
                ->requirePresence('content')
                ->allowEmpty('content');

            $errors = $validator->errors($this->request->getData());

            if ($errors) {
                throw new NotFoundException('Invalid request!');
            }

            $posts->uri = $data['image_uri'];
            $posts->menu_id = $data['menu_id'];
            $posts->title = $data['title'];
            $posts->slug = StringAPI::convertToAscii($data['title']);
            $posts->header = $data['header'];
            $posts->content = $data['content'];
            $posts->is_active = $data['is_active'];
            $posts->dsp_order = $data['dsp_order'];
            $posts->author = $this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name');

            if ($this->Posts->save($posts)) {
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
