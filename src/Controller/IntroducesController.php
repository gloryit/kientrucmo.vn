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
                'group_id' => 1,
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
     * @param null $slug
     */
    public function detail($slug = null)
    {
        /** @var \App\Model\Entity\Post $post */
        $post = $this->Posts->find()
            ->where([
                'slug' => $slug,
                'group_id' => 1,
                'delete_flag' => false
            ])
            ->first();

        /** @var \App\Model\Entity\Group $group */
        $group = $this->Groups->find()
            ->where([
                'id' => 1,
                'delete_flag' => false
            ])
            ->first();

        $this->set(compact('post', 'group'));
    }
}
