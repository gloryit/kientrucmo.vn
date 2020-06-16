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
            ->contain('Menus')
            ->where([
                'Posts.menu_id' => 3,
            ])
            ->orderDesc('created')
            ->toArray();

        $menu = $this->Menus->find()
            ->contain('Posts')
            ->where([
                'Menus.id' => 3,
            ])
            ->firstOrFail();

        $this->set(compact('posts', 'menu'));
    }

    /**
     * @param $slug
     * @return void
     */
    public function detail($slug) {
        /** @var \App\Model\Entity\Post $post */
        $post = $this->Posts->find()
            ->contain('Menus')
            ->where([
                'Posts.slug' => $slug,
            ])
            ->firstOrFail();

        /** @var \App\Model\Entity\Menu $menu */
        $menu = $this->Menus->find()
            ->contain('Posts')
            ->where([
                'Menus.id' => $post->menu_id,
            ])
            ->first();

        $this->set(compact('post', 'menu'));
    }
}
