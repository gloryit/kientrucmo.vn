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
            ->where([
                'group_id' => 4,
                'delete_flag' => false
            ])
            ->toArray();

        /** @var \App\Model\Entity\Group $group */
        $group = $this->Groups->find()
            ->where([
                'id' => 4,
                'delete_flag' => false
            ])
            ->first();

        $title = 'Tin tức - Thiết kế kiến trúc, nội thất... - + P A H - pah.com.vn';

        $this->set(compact('posts', 'group', 'title'));
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

        $title = $post->title . ' - Thiết kế kiến trúc, nội thất... - + P A H - pah.com.vn';
        $this->set(compact('post', 'group', 'title'));
    }
}
