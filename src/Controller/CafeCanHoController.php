<?php
/**
 * Created by PhpStorm.
 * User: phuctran
 * Date: 11/07/2018
 * Time: 09:23
 */

namespace App\Controller;

class CafeCanHoController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->set('isPage', 'cafe');
    }

    public function index() {
        $posts = $this->Posts->find()
            ->contain('Menus')
            ->where([
                'Menus.slug' => 'cafe-va-can-ho'
            ])
            ->toArray();
        $this->set(compact('posts'));
    }

    /**
     * @param $slug
     * @return void
     */
    public function detail($slug) {
        $post = $this->Posts->find()
            ->contain('Menus')
            ->where([
                'Menus.slug' => 'cafe-va-can-ho',
                'Posts.slug' => $slug
            ])
            ->firstOrFail();
        $this->set(compact('post'));
    }
}
