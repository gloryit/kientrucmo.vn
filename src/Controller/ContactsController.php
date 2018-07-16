<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 7:06 PM
 */

namespace App\Controller;


use Cake\Mailer\Email;

class ContactsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->set('isPage', 'contacts');
    }

    public function index() {
        $this->loadModel('Contacts');

        $contact = $this->Contacts->find()
            ->firstOrFail();

        $this->set(compact('contact'));

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
            $email->setTo(EMAIL_DEFAULT['from']);
            $email
                ->setEmailFormat('html')
                ->addCc(EMAIL_DEFAULT['from'])
                ->setSubject($data['subject'])
                ->send($datas);

            $this->redirect('/');
        }
    }
}
