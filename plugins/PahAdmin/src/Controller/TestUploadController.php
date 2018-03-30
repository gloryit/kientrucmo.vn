<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 05/01/2018
 * Time: 10:35
 */

namespace PahAdmin\Controller;


/**
 * @property \App\Model\Table\WebsiteImagesTable $WebsiteImages
 */
class TestUploadController extends AdminController {

    public $flash_error_key = 'qewrewr';


    public function edit() {
        $this->loadModel('Posts');
        $this->loadModel('WebsiteImages');
        $toppage_logo = $this->Posts->find()->first();
        $logos = $this->WebsiteImages->find()->toArray();
        $this->set(compact('flash_error_key', 'toppage_logo', 'logos'));
    }
}
