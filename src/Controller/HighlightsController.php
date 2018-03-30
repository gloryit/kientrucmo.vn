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
                'group_id' => 3,
                'delete_flag' => false
            ])
            ->orderDesc('created')
            ->toArray();

        $group = $this->Groups->find()
            ->where([
                'id' => 3,
                'delete_flag' => false
            ])
            ->firstOrFail();

        $this->set(compact('posts', 'group'));
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

        /** @var \App\Model\Entity\Group $group */
        $group = $this->Groups->find()
            ->where([
                'id' => $post->group_id,
                'delete_flag' => false
            ])
            ->first();

        $this->set(compact('post', 'group'));
    }
}
