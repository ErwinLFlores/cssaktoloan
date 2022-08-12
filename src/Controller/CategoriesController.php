<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Categories Controller
 *
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
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

    public function index()
    {
        $this->set('page_title', 'Manage Categories');
        $categories = $this->paginate($this->Categories);
        $this->set(compact('categories'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->loggerIt('Categories', 'add', $this->Auth->user('id'), $category, 'Categories Add');
                $this->Flash->formsuccess(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->loggerIt('Categories', 'add', $this->Auth->user('id'), $category, 'Categories Add Failed');
                $this->Flash->formerror(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
    }
}
