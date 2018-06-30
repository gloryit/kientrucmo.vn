<?php

namespace PahAdmin\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * Class AdminController
 * @package PahAdmin\Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 * @property \App\Model\Table\ContactsTable $Contacts
 * @property \App\Model\Table\BannersTable $Banners
 * @property \App\Model\Table\MenusTable $Menus
 */
class AdminController extends Controller
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        Time::setToStringFormat('M/d/Y H:m');
        Date::setToStringFormat('M/d/Y');
        $this->loadComponent('Csrf');
        $this->loadComponent('Flash');

        $this->viewBuilder()->setClassName('PahAdmin.Admin');

        // Existing code
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Auth', [
            // Added this line
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
                'plugin' => 'PahAdmin'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'plugin' => 'PahAdmin'
            ],
            'loginRedirect' => [
                'controller' => 'Posts',
                'action' => 'index',
                'plugin' => 'PahAdmin'
            ],
            'authError' => 'Did you really think you are allowed to see that?'
        ]);

        $this->loadModel('Menus');
        $menus = $this->Menus->find()->toArray();

        $options = [
            '0' => 'Default'
        ];
        if (!empty($menus)) {
            foreach ($menus as $option) {
                $options[h($option->id)] = mb_ucwords(h($option->title));
            }
        }

        $this->set(compact('options'));
    }

    /**
     * @param Event $event
     * @return void
     */
    public function beforeRender(Event $event) {
//         Login check
        if ($this->Auth->user()) {
            $this->set('LoggedIn', true);
            $this->set('user', $this->Auth->user()??[]);
        } else {
            $this->set('LoggedIn', false);
        }
    }
}
