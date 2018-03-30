<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 16/01/2018
 * Time: 11:27
 */

namespace PahAdmin\Controller;

use App\Controller\API\StringAPI;
use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;

/**
 * Class BannersController
 * @package PahAdmin\Controller
 */
class BannersController extends AdminController {

    protected $banner_key = 'banner';

    public function initialize() {
        parent::initialize();
        $this->loadModel('Banners');
    }

    /**
     * @param null $id
     */
    public function update($id = null) {
        /** @var \App\Model\Entity\Banner $banner */

        $banner_key = $this->banner_key;

        $id = intval($id);

        if ($id) {
            $banner = $this->Banners->find()
                ->where([
                    'id' => $id
                ])
                ->firstOrFail();
        } else {
            $banner = $this->Banners->newEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $validator = new Validator();
            $validator
                ->requirePresence('title')
                ->notEmpty('title')
                ->requirePresence('image_uri')
                ->allowEmpty('image_uri')
                ->requirePresence('is_active')
                ->allowEmpty('is_active');

            $errors = $validator->errors($this->request->getData());

            if ($errors) {
                throw new NotFoundException('Invalid request!');
            }

            $data = $this->request->getData();
            $banner->title = $data['title'];
            $banner->slug = StringAPI::convertToAscii($data['title']);
            $banner->uri = $data['image_uri'];
            $banner->is_active = $data['is_active'];

            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('The user has been saved.'), ['key' => 'contact_key']);
                $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'), ['key' => 'contact_key']);
        }
        $this->set(compact('banner', 'banner_key'));
    }
}