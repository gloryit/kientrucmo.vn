<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @property \App\Model\Table\PostsTable $Posts
 * @property \App\Model\Table\MenusTable $Menus
 * @property \App\Model\Table\ContactsTable $Contacts
 * @property \App\Model\Table\SlidesTable $Slides
 * @property \App\Model\Table\WebsiteImagesTable $WebsiteImages
 * @property \PahAdmin\Controller\Component\WebsiteImageComponent $WebsiteImage
 * @property \App\Model\Table\BannersTable $Banners
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        $this->loadComponent('Csrf');
        $this->loadModel('Posts');
        $this->loadModel('Menus');
        $this->loadModel('Contacts');
        $this->loadModel('Slides');
        $this->loadModel('Banners');

        /** @var \App\Model\Entity\Post $app_introduces */
        $app_introduces = $this->Posts->find()
            ->where([
                'menu_id' => 2,
            ])
            ->toArray();

        /** @var \App\Model\Entity\Post[] $app_services */
        $app_services = $this->Posts->find()
            ->where([
                'menu_id' => 3,
            ])
            ->toArray();

        $sub_services = $this->Menus->find()
            ->where([
                'parent_id' => 3,
            ])
            ->toArray();

        $app_highlights = $this->Posts->find()
            ->where([
                'menu_id' => 3,
            ])
            ->orderDesc('created')
            ->limit(8)
            ->toArray();
        /** @var \App\Model\Entity\Post $app_introduce */
        $app_introduce = $this->Posts->find()
            ->where([
                'menu_id' => 3,
            ])
            ->first();

        $app_contact = $this->Contacts->find()
            ->firstOrFail();

        $app_slides = $this->Slides->find()
            ->orderDesc('created')
            ->limit(6)
            ->toArray();

        $page_banner = $this->Banners->find()
            ->where([
                'id' => 2
            ])
            ->first();

        $this->set(compact('app_introduces', 'sub_services', 'app_services', 'app_highlights', 'app_introduce', 'app_contact', 'app_slides', 'page_banner'));
        $this->set('isPage', 'homes');
        $this->set('keywords', 'thiet ke noi that can ho dep, thiết kế nội thất căn hộ đẹp, thiet ke noi that van phong hien dai, thiết kế nội thất văn phòng hiện đại, thiet ke noi that shop, thiết kế nội thất shop');
        $this->set('description', '+ P A H chuyên thiết kế và thi công Nội thất Văn phòng, Showroom, Shop, Biệt thự, Căn hộ theo phong cách Scandinavia &amp; Minimalism / Our Experts in Scandinavia &amp; Minimalism Interior Design');
        $this->set('generator', 'CÔNG TY TNHH KIẾN TRÚC NỘI THẤT + P A H');
        $this->set('title', 'Thiết kế kiến trúc, nội thất... - + P A H');
    }

    /**
     * Short-hand controller ajax response
     * @param array|object|bool $data Array to return.
     * @return \Cake\Http\Response|null
     */
    protected function ajaxResponse($data)
    {
        return $this->response->withType('application/json')
            ->withStringBody($this->toJson($data));
    }

    /**
     * Json encode for easy debug
     * @param mixed $data Input data.
     * @return mixed|string
     */
    protected function toJson($data)
    {
        if (version_compare(PHP_VERSION, '5.4.0', '>=') && PAH_DEBUG) {
            $options = JSON_PRETTY_PRINT;
        }

        return json_encode($data, $options ?? 0);
    }
}
