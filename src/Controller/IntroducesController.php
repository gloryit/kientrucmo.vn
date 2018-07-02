<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 11:41 PM
 */

namespace App\Controller;

/**
 * Class IntroducesController
 * @package App\Controller
 */
class IntroducesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->set('isPage', 'introduces');
    }

    /**
     * @return void
     */
    public function index() {
        $posts = $this->Posts->find()
            ->where([
                'menu_id' => 1,
            ])
            ->orderDesc('created')
            ->toArray();

        $menu = $this->Menus->find()
            ->where([
                'id' => 3,
            ])
            ->firstOrFail();

        $this->set(compact('posts', 'menu'));
    }

    /**
     * @param null $slug
     */
    public function detail($slug = null)
    {
        /** @var \App\Model\Entity\Post $post */
        $post = $this->Posts->find()
            ->where([
                'slug' => $slug,
                'menu_id' => 1,
            ])
            ->first();

        /** @var \App\Model\Entity\Menu $menu */
        $menu = $this->Menus->find()
            ->where([
                'id' => 1,
            ])
            ->first();

        $this->set(compact('post', 'menu'));
    }
}
