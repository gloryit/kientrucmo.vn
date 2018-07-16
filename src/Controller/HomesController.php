<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 06/01/2018
 * Time: 08:51
 */

namespace App\Controller;

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
            ->contain('Menus')
            ->order(['RAND()'])
            ->where([
                'Menus.slug NOT IN' => ['gioi-thieu', 'lien-he', 'cafe-va-can-ho'],
            ])
            ->limit(3)
            ->toArray();

        $news = $this->Posts->find()
            ->where([
                'menu_id' => 4,
            ])
            ->orderDesc('created')
            ->toArray();

        $highlights = $this->Posts->find()
            ->where([
                'menu_id' => 3,
            ])
            ->orderDesc('created')
            ->limit(6)
            ->toArray();

        $top_banner = $this->Banners->find()
            ->where([
                'id' => 1
            ])
            ->first();

        $page_banner = $this->Banners->find()
            ->where([
                'id' => 2
            ])
            ->first();

        $this->set(compact('tops', 'news', 'highlights', 'top_banner', 'page_banner'));
    }
}
