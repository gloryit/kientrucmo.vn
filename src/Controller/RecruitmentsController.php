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
        $this->loadModel('Groups');
    }

    public function index() {

        /** @var \App\Model\Entity\Post $post */
        $post = $this->Posts->find()
            ->where([
                'group_id' => 7,
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

        $this->set(compact('post', 'group'));
    }

}
