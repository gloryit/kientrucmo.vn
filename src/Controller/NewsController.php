<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 7:16 PM
 */

namespace App\Controller;

/**
 * Class NewsController
 * @package App\Controller
 */
class NewsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->set('isPage', 'news');
    }

    /**
     * @return void
     */
    public function index() {
        /** @var \App\Model\Entity\Post[] $posts */
        $posts = $this->Posts->find()
            ->contain('Menus')
            ->where([
                'Posts.menu_id' => 4,
            ])
            ->toArray();

        /** @var \App\Model\Entity\Menu $menu */
        $menu = $this->Menus->find()
            ->contain('Posts')
            ->where([
                'Menus.id' => 4,
            ])
            ->first();

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
