<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 06/01/2018
 * Time: 08:51
 */

namespace App\Controller;

/**
 * Class HomesController
 * @package App\Controller
 */
class HomesController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->loadModel('Posts');
        $this->loadModel('Menus');
        $this->loadModel('Slides');
        $this->loadModel('Banners');
    }

    public function index() {
        $tops = $this->Posts->find()
            ->order(['RAND()'])
            ->where([
                'menu_id' => 2,
                'delete_flag' => false
            ])
            ->limit(3)
            ->toArray();

        $news = $this->Posts->find()
            ->where([
                'menu_id' => 4,
                'delete_flag' => false
            ])
            ->orderDesc('created')
            ->toArray();

        $highlights = $this->Posts->find()
            ->where([
                'menu_id' => 3,
                'delete_flag' => false
            ])
            ->orderDesc('created')
            ->limit(6)
            ->toArray();

        $top_banner = $this->Banners->find()
            ->where([
                'delete_flag' => false,
                'id' => 1
            ])
            ->first();

        $page_banner = $this->Banners->find()
            ->where([
                'delete_flag' => false,
                'id' => 2
            ])
            ->first();

        $this->set(compact('tops', 'news', 'highlights', 'top_banner', 'page_banner'));
    }
}
