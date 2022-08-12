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
            $this_username = $this->request->getData('username');
            $user_data = $this->Users->checkUsername($this_username);

            if (
                (!empty($user_data))
                && ($user_data->status === 1)
            ) {
                $user = $this->Auth->identify();

                if (!empty($user)) {
                    $user_role = $user_data->role;
                    $this->loadModel('RolesAccess');
                    $active_roles = $this->RolesAccess->find('all')
                        ->where(['role_id' => $user_data->role_id])
                        ->all();
                    $current_roles = [];

                    foreach ($active_roles as $key => $role) {
                        $user['roles'][$role->controller_type] = [
                            'action_index' => $role->action_index,
                            'action_view' => $role->action_view,
                            'action_add' => $role->action_add,
                            'action_edit' => $role->action_edit,
                            'action_delete' => $role->action_delete,
                            'action_prints' => $role->action_prints,
                            'action_members' => $role->action_members,
                            'action_reports' => $role->action_reports
                        ];
                    }

                    $this->Auth->setUser($user);
                    $this->log_login_logs($this_username, 'Logged In', $this->request->clientIp());
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->log_login_logs($this_username, 'Login Attempt', $this->request->clientIp());
                    $this->Flash->error(__('Entry is either incorrect or invalid. Try again.'));
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

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add()
    {
        $user = $this->Users->newEntity();

        $this->loadModel('Roles');
        $roles_list = $this->Roles->getAll();
        $this->set(compact('roles_list'));

        if ($this->request->is('post')) {
            if ($this->passwordChecker($this->request->data['password'])) {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                $user->status = 1;
                $is_save = 1;

                if ($is_save) {
                    if ($this->Users->save($user)) {
                        $this->loggerIt('Users', 'add', $this->Auth->user('id'), $user, 'User Added');
                        $this->Flash->formsuccess(__('The user has been saved.'));
    
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->loggerIt('Users', 'add', $this->Auth->user('id'), $user, 'User Add Failed');
                        $this->Flash->formerror(__('The user could not be saved. Please, try again.'));
                    }
                }
            } else {
                $this->Flash->formerror(__(' Password should be at least 8 Characters, with at least: 1 Uppercase, 1 Number and 1 Special Character.'));
                return $this->redirect($this->referer());
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function edit($id)
    {
        $user = $this->Users->get($id);

        $this->loadModel('Roles');
        $roles_list = $this->Roles->getAll();
        $this->set(compact('roles_list'));

        if ($this->request->is(['post'])) {
            $is_continue = 0;

            if (!empty($user)) {
                if (!empty($this->request->data['password'])) {
                    if ($this->passwordChecker($this->request->data['password'])) {
                        $is_continue = 1;
                    } else {
                        $this->Flash->formerror(__(' Password should be at least 8 Characters, with at least: 1 Uppercase, 1 Number and 1 Special Character.'));
                        return $this->redirect($this->referer());
                    }
                } else {
                    unset($this->request->data['password']);
                    $is_continue = 1;
                }

                if ($is_continue) {
                    $roles = $this->Auth->user('roles');
                    $logged_role = $this->Auth->user('role_id');

                    if (!empty($roles)) {
                        if ($user->role_id >= $logged_role) {
                            unset($this->request->data['role_id']);
                            $user = $this->Users->patchEntity($user, $this->request->data);

                            if ($this->Users->save($user)) {
                                $this->loggerIt('Users', 'edit', $this->Auth->user('id'), $user, 'User Edit');
                                $this->Flash->formsuccess(__('The user has been updated.'));
                            } else {
                                $this->loggerIt('Users', 'edit', $this->Auth->user('id'), $user, 'User Edit Failed');
                                $this->Flash->formerror(__('The user was not updated.'));
                            }
                        } else {
                            $this->Flash->formerror(__('You are not authorized to update this user.'));
                        }
                    }
                }
            } else {
                $this->Flash->formerror(__('User not found'));
            }

            return $this->redirect($this->referer());
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function delete($user_id)
    {
        $this->autorender = false;
        $this->autolayout = false;

        if ($this->request->is(['post'])) {
            $user = $this->Users->get($user_id);

            if (!empty($user)) {
                $role_id = $this->Auth->user('role_id');
                $logged_user_id = $this->Auth->user('id');

                if ($role_id < $user->role_id) {
                    $roles = $this->Auth->user('roles');
                    $updated_status = 0;

                    if (!empty($roles)) {
                        if ($roles['Users']['action_delete'] === 1) {
                            if ($user->status === 0) {
                                $updated_status = 1;
                            }
                            $user = $this->Users->patchEntity($user, ['status' => $updated_status]);

                            if ($this->Users->save($user)){
                                $this->loggerIt('Users', 'delete', $this->Auth->user('id'), $user, 'User Edit Status (Delete)');
                                $this->Flash->formsuccess(__('The role status has been updated.'));
                            } else {
                                $this->loggerIt('Users', 'delete', $this->Auth->user('id'), $user, 'User Edit Status Failed (Delete)');
                                $this->Flash->formsuccess(__('The role status was not updated.'));
                            }
                        } else {
                            $this->Flash->formerror(__('You are not authorized to deactivate this user'));
                        }
                    } else {
                        $this->Flash->formerror(__('Roles not found'));
                    }
                } else {
                    $this->Flash->formerror(__('You are not authorized to deactivate this type of user'));
                }
            } else {
                $this->Flash->formerror(__('User not found'));
            }
        }

        return $this->redirect(['controller' => 'users', 'action' => 'index']);
    }
}
