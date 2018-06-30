<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 7:06 PM
 */

namespace App\Controller;

use Cake\Mailer\Email;

/**
 * Class ContactsController
 * @package App\Controller
 */
class ContactsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->set('isPage', 'contacts');
    }

    public function index() {
        $this->loadModel('Contacts');

        $contact = $this->Contacts->find()
            ->where([
                'delete_flag' => false
            ])
            ->firstOrFail();

        $title = 'Liên hệ - Thiết kế kiến trúc, nội thất... - + P A H - pah.com.vn';

        $this->set(compact('contact', 'title'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $datas = '<div id=":oe" class="ii gt ">
              <div id=":od" class="a3s aXjCH m160fda4c3e9e79c2">
                <div dir="ltr">
                  <i>Người gửi:<b>'. $data['name'] .'</b></i>
                  <div>
                    <i>Email người gửi:<b>' . $data['email'] . '</b><br></i>
                    <div><i>Nội dung:<b>&nbsp; ' . $data['content'] . '</b></i></div>
                  </div>
                </div>
                <div class="yj6qo"></div>
                <div class="adL"></div>
              </div>
            </div>
            ';

            $email = new Email();
            $email->setTo('kientruc.pah@gmail.com');
            $email
                ->setEmailFormat('html')
                ->addCc('kientruc.pah@gmail.com')
                ->setSubject($data['subject'])
                ->send($datas);
        }
    }
}