<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 11:53 PM
 */

namespace App\Controller;


class RecruitmentsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->set('isPage', 'recruitments');
        $this->loadModel('Posts');
        $this->loadModel('Menus');
    }

    public function index() {

        /** @var \App\Model\Entity\Post $post */
        $post = $this->Posts->find()
            ->where([
                'menu_id' => 7,
                'delete_flag' => false
            ])
            ->first();

        /** @var \App\Model\Entity\Menu $menu */
        $menu = $this->Menus->find()
            ->where([
                'id' => $post->menu_id,
            ])
            ->first();

        $title = 'Tuyển dụng - Thiết kế kiến trúc, nội thất... - + P A H - pah.com.vn';

        $this->set(compact('post', 'menu', 'title'));
    }

}