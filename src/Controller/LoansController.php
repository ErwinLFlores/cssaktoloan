<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Loans Controller
 *
 * @property \App\Model\Table\LoansTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoansController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user());
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'login', 'logout']);
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        // $this->isAuthorized($this->Auth->user());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $this->loggerIt('Users', 'index', $this->Auth->user('id'));
        $this->set('page_title', 'User List');

        // $this->paginate = [
        //     'contain' => ['Roles'],
        // ];

        // $users = $this->paginate($this->Users);
        // $this->set(compact('index'));
    }


    public function borrow()
    {
        $this->set('page_title', 'Borrow');


        $data = [
            'id' => '1'
        ];

        $this->set('data', $data);
    }

    public function borrowAdd()
    {
        $this->set('page_title', 'Create Borrow');


        $data = [
            'id' => '1'
        ];

        $this->set('data', $data);
    }

    public function borrowUpdate()
    {
        $this->set('page_title', 'Update Borrow');


        $data = [
            'id' => '1'
        ];

        $this->set('data', $data);
    }
}
