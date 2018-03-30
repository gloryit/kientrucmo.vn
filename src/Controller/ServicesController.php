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
                'group_id' => 2,
                'delete_flag' => false
            ])
            ->orderDesc('created')
            ->toArray();

        $group = $this->Groups->find()
            ->where([
                'id' => 2,
                'delete_flag' => false
            ])
            ->firstOrFail();

        $this->set(compact('posts', 'group'));
    }

    /**
     * @param $slug
     */
    public function detail($slug) {
        /** @var \App\Model\Entity\Post $post */
        $post = $this->Posts->find()
            ->where([
                'slug' => $slug,
                'group_id' => 2,
                'delete_flag' => false
            ])
            ->first();

        /** @var \App\Model\Entity\Group $group */
        $group = $this->Groups->find()
            ->where([
                'id' => $post->group_id,
                'delete_flag' => false
            ])
            ->first();

        $any = $this->Posts->find()
            ->where([
                'slug !=' => $slug,
                'group_id' => 2,
                'delete_flag' => false
            ])
            ->toArray();

        $this->set(compact('post', 'group', 'any'));
    }

}
