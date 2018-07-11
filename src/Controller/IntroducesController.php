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
    public function introduce()
    {
        $post = $this->Posts->find()
            ->contain('Menus')
            ->where([
                'Menus.slug' => 'gioi-thieu'
            ])
            ->firstOrFail();
        $this->set(compact('post'));
    }
}
