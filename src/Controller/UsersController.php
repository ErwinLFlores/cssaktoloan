<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
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

    public function login()
    {
        if (!empty($this->Auth->user())) {
            $this->redirect('/');
        }

        if ($this->request->is('post')) {
            $this_email = $this->request->getData('email');
            $user_data = $this->Users->checkEmail($this_email);

            if (
                (!empty($user_data))
                && ($user_data->status === 'active')
            ) {
                $user_role = $user_data->role;
                $user = $this->Auth->identify();
                
                if ($user) {
                    $this->Auth->setUser($user);

                    if ($user_role == 'admin') {

                    } else {
    
                    }
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error(__('Entry is either incorrect or invalid [2]. Try again.'));
                }
            } else {
                $this->Flash->error(__('Entry is either incorrect or invalid. Try again.'));
            }
        }
    }

    public function logout()
    {
        $user = $this->Auth->user('username');
        $this->log_login_logs($user, 'Logged Out', $this->request->clientIp());
        return $this->redirect($this->Auth->logout());
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

        $this->paginate = [
            'contain' => ['Roles'],
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }
}
