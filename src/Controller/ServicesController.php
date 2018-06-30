<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 11:33 PM
 */

namespace App\Controller;


class ServicesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->set('isPage', 'services');
    }

    /**
     * @return void
     */
    public function index() {
        $posts = $this->Posts->find()
            ->where([
                'menu_id' => 2,
                'delete_flag' => false
            ])
            ->orderDesc('created')
            ->toArray();

        $menu = $this->Menus->find()
            ->where([
                'id' => 2,
            ])
            ->firstOrFail();

        $title = 'Dịch vụ - Thiết kế kiến trúc, nội thất... - + P A H - pah.com.vn';

        $this->set(compact('posts', 'menu', 'title'));
    }

    /**
     * @param $slug
     */
    public function detail($slug) {
        /** @var \App\Model\Entity\Post $post */
        $post = $this->Posts->find()
            ->where([
                'slug' => $slug,
                'menu_id' => 2,
                'delete_flag' => false
            ])
            ->first();

        /** @var \App\Model\Entity\Menu $menu */
        $menu = $this->Menus->find()
            ->where([
                'id' => $post->menu_id,
            ])
            ->first();

        $any = $this->Posts->find()
            ->where([
                'slug !=' => $slug,
                'menu_id' => 2,
                'delete_flag' => false
            ])
            ->toArray();

        $title = $post->title . ' - Thiết kế kiến trúc, nội thất... - + P A H - pah.com.vn';

        $this->set(compact('post', 'menu', 'any', 'title'));
    }

}
