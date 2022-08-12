<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Census Controller
 *
 *
 * @method \App\Model\Entity\Census[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CensusController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user());
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $census = $this->paginate($this->Census);

        $this->set(compact('census'));
    }

    /**
     * View method
     *
     * @param string|null $id Census id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->isAuthorized($this->Auth->user());
        exit;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $census = $this->Census->newEntity();
        if ($this->request->is('post')) {
            $census = $this->Census->patchEntity($census, $this->request->getData());
            if ($this->Census->save($census)) {
                $this->Flash->success(__('The census has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The census could not be saved. Please, try again.'));
        }
        $this->set(compact('census'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Census id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $census = $this->Census->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $census = $this->Census->patchEntity($census, $this->request->getData());
            if ($this->Census->save($census)) {
                $this->Flash->success(__('The census has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The census could not be saved. Please, try again.'));
        }
        $this->set(compact('census'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Census id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $census = $this->Census->get($id);
        if ($this->Census->delete($census)) {
            $this->Flash->success(__('The census has been deleted.'));
        } else {
            $this->Flash->error(__('The census could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
