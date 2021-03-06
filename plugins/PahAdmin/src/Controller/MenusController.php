<?php

namespace PahAdmin\Controller;

use App\Controller\API\StringAPI;

/**
 * Class GroupController
 * @property \App\Model\Table\MenusTable $Menus
 * @property \App\Model\Table\LogosTable $Logos
 * @package App\Controller
 */
class MenusController extends AdminController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function index() {}

    /**
     * @param null $id
     * @return \Cake\Http\Response|null
     * @throws \Aura\Intl\Exception
     */
    public function logo($id = null) {
        $logo_key = 'logo_key';
        $id = (int) $id;
        $this->loadModel('Logos');

        /** @var \App\Model\Entity\Logo $logo */
        $logo = $this->Logos->find()
            ->where([
                'id' => $id
            ])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $logo->uri = $data['image_uri'];
            $logo->name = $data['name'];
            $logo->alias = $data['alias'];

            if ($this->Logos->save($logo)) {
                $this->Flash->success(__('The user has been saved.'), ['key' => 'logo_key']);
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'), ['key' => 'logo_key']);
        }

        $this->set(compact('logo', 'logo_key'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function datatables() {
        $this->response = $this->response->withHeader('Content-Type', 'application/json');

        $params = $this->_parse_datatables_params();

        /** @var \App\Model\Entity\Menu[] $menus */
        $menus_query = $this->Menus->find()->orderAsc('lft');

        $params['recordsFiltered'] = $params['recordsTotal'] = $menus_query->count();

        $menus_query->orderDesc('created')
            ->where([
                'name LIKE' => '%' . $params['keyword'] . '%',
            ])
            ->limit($params['length'])->offset($params['start']);

        $menus = $menus_query->toArray();

        $params['data'] = $menus;

        return $this->response->withHeader('Content-Type', 'application/json')
            ->withStringBody(json_encode($params));
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Aura\Intl\Exception
     */
    public function edit($id = null) {
        /** @var \App\Model\Entity\Menu $menu */
        if ( $id ) {
            $menu = $this->Menus->find()
                ->where([
                    'id' => $id,
                ])
                ->first();
        } else {
            $menu = $this->Menus->newEntity();
        }

        $this->set(compact('menu'));

        if($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->getData();

            if ($data['parent_id'] != null) {
                $menu->parent_id = $data['parent_id'];
            }
            $menu->name = $data['name'];
            $menu->description = $data['description'];
            $menu->slug = StringAPI::convertToAscii(strtolower($data['name']));
            $menu->is_active = $data['is_active'];

            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The user has been saved.'), ['key' => 'menus_key']);

                if ($menu->parent_id) {
                    /** @var \App\Model\Entity\Menu $old_menu */
                    $old_menu = $this->Menus->find()
                        ->where([
                            'id' => $menu->parent_id
                        ])
                        ->first();

                    if ($old_menu) {
                        $old_menu->level = true;
                        $this->Menus->save($old_menu);
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'), ['key' => 'menus_key']);
        }
    }

    /**
     * @return array
     */
    protected function _parse_datatables_params() {
        $params = array(
            'start' => floor($this->request->getQuery('start')),
            'length' => floor($this->request->getQuery('length')),
            'draw' => floor($this->request->getQuery('draw')),
        );

        if($params['length'] > 200) {
            $params['length'] = 50;
        }

        $search = $this->request->getQuery('search'); //value: value search, regex: true/false
        $order = $this->request->getQuery('order');

        $params['direction'] = $params['column_ordered'] = false;
        if($order && isset($order[0])) {
            if(isset($order[0]['column'])) {
                $params['column_ordered'] = $order[0]['column']; // Direction, not need to validate
            }

            if(isset($order[0]['dir'])) {
                $params['direction'] = $order[0]['dir']; // Direction, not need to validate
            }
        };

        $params['keyword'] = false;
        if(isset($search['value']) && $search['value'] != "" && strlen($search['value']) < 250) {
            $params['keyword'] = $search['value'];
        };

        return $params;
    }

    /**
     * @param null $id
     * @return string
     */
    public function delete($id = null)
    {
        $this->response = $this->response->withType('application/json');
        if($this->request->is(['post', 'delete'])) {
            /** @var \App\Model\Entity\Menu $menu */
            $menu = $this->Menus->find()
                ->where([
                    'id' => intval($id)
                ])
                ->first();

            if ($this->Menus->delete($menu)) {
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
}
