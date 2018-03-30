<?php

namespace PahAdmin\Controller;
use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;

/**
 * Class TranslateController
 * @property \App\Model\Table\TranslateTable $Translate
 * @package PahAdmin\Controller
 */
class TranslateController extends AdminController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Translate');
    }

    public function index() {

    }
    public function datatables() {
        $this->response = $this->response->withHeader('Content-Type', 'application/json');

        $total = $this->Translate->find()->count();
        $logo_info = $this->Translate->find()->toArray();

        $data = [
            'draw' => (int) $this->request->getQuery('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $logo_info
        ];

        $this->response = $this->response->withStringBody( json_encode( $data ) );
        return $this->response;
    }

    public function edit($id = null) {
        if ( $id ) {
            $translate = $this->Translate->find()
                ->where([
                    'id' => $id
                ])
                ->first();
        } else {
            $translate = $this->Translate->newEntity();
        }
        if ($this->request->is('post')) {
            $request = $this->request;
            $data = $request->getData();
            /** @var \App\Model\Entity\Translate $translate */

            $validator = new Validator();

            $validator
                ->requirePresence('message')
                ->notEmpty('message')
                ->requirePresence('lang_vi')
                ->notEmpty('lang_vi')
                ->requirePresence('lang_en')
                ->notEmpty('lang_en');

            $errors = $validator->errors($this->request->getData());

            if($errors) {
                throw new NotFoundException('Invalid request!');
            }

            $error = $this->Translate->find()
                ->where([
                    'message' => $data['message']
                ])
                ->count();

            if ($error > 1) {
                throw new NotFoundException('The message already exists!');
            }

            $translate->lang_vi = $data['lang_vi'];
            $translate->lang_en = $data['lang_en'];
            $translate->message = $data['message'];

            if ($this->Translate->save($translate)) {
                $this->Flash->success(__('The user has been saved.'), ['key' => 'posts_key']);

                $this->update();

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'), ['key' => 'posts_key']);
        }
        $this->set(compact('translate'));
    }

    public function update() {
        if (is_file(LOCALE_EN) && is_file(LOCALE_VI)) {
            $translation = $this->Translate->find()
                ->toArray();
            $en = fopen(LOCALE_EN, 'w+');
            $vi = fopen(LOCALE_VI, 'w+');
            foreach ($translation as $translate) {
                fwrite($en, 'msgid ' . '"'. $translate['message'] . '"' . "\n");
                fwrite($en, 'msgstr ' . '"' . $translate['lang_en'] . '"' . "\n\n");
                fwrite($vi, 'msgid ' . '"' . $translate['message'] . '"' . "\n");
                fwrite($vi, 'msgstr ' . '"' . $translate['lang_vi'] . '"' . "\n\n");
            }
            fclose($en);
            fclose($vi);
        }
    }
}
