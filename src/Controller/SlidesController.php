<?php
namespace App\Controller;

/**
 * Class SlidesController
 * @package App\Controller
 */
class SlidesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $slides = $this->paginate($this->Slides);

        $this->set(compact('slides'));
    }

    /**
     * View method
     *
     * @param string|null $id Slide id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $slide = $this->Slides->get($id, [
            'contain' => []
        ]);

        $this->set('slide', $slide);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $slide = $this->Slides->newEntity();
        if ($this->request->is('post')) {
            $slide = $this->Slides->patchEntity($slide, $this->request->getData());
            if ($this->Slides->save($slide)) {
                $this->Flash->success(__('The slide has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slide could not be saved. Please, try again.'));
        }
        $this->set(compact('slide'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Slide id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $slide = $this->Slides->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $slide = $this->Slides->patchEntity($slide, $this->request->getData());
            if ($this->Slides->save($slide)) {
                $this->Flash->success(__('The slide has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slide could not be saved. Please, try again.'));
        }
        $this->set(compact('slide'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Slide id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $slide = $this->Slides->get($id);
        if ($this->Slides->delete($slide)) {
            $this->Flash->success(__('The slide has been deleted.'));
        } else {
            $this->Flash->error(__('The slide could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
