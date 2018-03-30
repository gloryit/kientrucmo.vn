<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/8/2018
 * Time: 11:47 PM
 */

namespace App\Controller;

use Cake\Event\Event;

/**
 * Class AppErrorController
 * @package App\Controller
 *
 */
class AppErrorController extends AppController
{
    /**
     * @param Event $event Event.
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow();
    }

    /**
     * @return void
     */
    public function initialize()
    {
        $this->viewBuilder()->setTemplatePath('Error');

        parent::initialize();
    }

    /**
     * @return void
     */
    public function index() {
        $this->render('error400');
    }

    /**
     * @param Event $event Event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        if($this->request->getUri()->getPath() !== '/error404.php') {
            $this->redirect('/error404.php');
        }
    }
}
