<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 11:00 PM
 */

namespace App\Controller;

class HighlightsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->set('isPage', 'highlights');
    }

    public function index() {
        $posts = $this->Posts->find()
            ->where([
                'menu_id' => 3,
                'delete_flag' => false
            ])
            ->orderDesc('created')
            ->toArray();

        $menu = $this->Menus->find()
            ->where([
                'id' => 3,
            ])
            ->firstOrFail();

        $title = 'Dự án tiêu biểu - Thiết kế kiến trúc, nội thất... - + P A H - pah.com.vn';

        $this->set(compact('posts', 'menu', 'title'));
    }

    /**
     * @param $slug
     * @return void
     */
    public function detail($slug) {
        /** @var \App\Model\Entity\Post $post */
        $post = $this->Posts->find()
            ->where([
                'slug' => $slug,
                'delete_flag' => false
            ])
            ->firstOrFail();

        /** @var \App\Model\Entity\Menu $menu */
        $menu = $this->Menus->find()
            ->where([
                'id' => $post->menu_id,
            ])
            ->first();

        $title = $post->title . ' - Thiết kế kiến trúc, nội thất... - + P A H - pah.com.vn';

        $this->set(compact('post', 'menu', 'title'));
    }
}
