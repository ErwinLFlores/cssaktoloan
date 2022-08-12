<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 *
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
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
        $this->set('page_title', 'Manage Roles');

        $roles = $this->paginate($this->Roles);
        $this->set(compact('roles'));
    }

    public function add()
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->loggerIt('Roles', 'add', $this->Auth->user('id'), $role, 'Role Added');
                $this->Flash->formsuccess(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->loggerIt('Roles', 'add', $this->Auth->user('id'), $role, 'Role Add Failed');
                $this->Flash->formerror(__('The role could not be saved. Please, try again.'));
            }
            return $this->redirect($this->referer());
        }
        $this->set(compact('role'));
    }

    public function delete($role_id)
    {
        $this->autorender = false;
        $this->autolayout = false;

        if ($this->request->is(['post'])) {
            $role = $this->Roles->get($role_id);
            $updated_status = 0;

            if (!empty($role)) {
                $logged_role = $this->Auth->user('role_id');
                $logged_roles = $this->Auth->user('roles');

                if ($logged_roles['Roles']['action_delete'] === 1) {
                    if ($role->status === 0) {
                        $updated_status = 1;
                    }

                    if ($logged_role < $role->id) { 
                        $role = $this->Roles->patchEntity($role, ['status' => $updated_status]);

                        if ($this->Roles->save($role)){
                            $this->loggerIt('Roles', 'delete', $this->Auth->user('id'), $role, 'Role Edit Status (Delete)'); 
                            $this->Flash->formsuccess(__('The role status has been updated.'));
                        } else {
                            $this->loggerIt('Roles', 'delete', $this->Auth->user('id'), $role, 'Role Edit Status Failed (Delete)');
                            $this->Flash->formsuccess(__('The role status was not updated.'));
                        }
                    } else {
                        $this->Flash->formerror(__('You are not authorized to delete this user'));
                    }
                } else {
                    $this->Flash->formerror(__('You are not authorized to deactivate this role'));
                }
            } else {
                $this->Flash->formerror(__('Role not found'));
            }
        }

        return $this->redirect(['controller' => 'roles']);
    }
}
