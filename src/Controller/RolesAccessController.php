<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * RolesAccess Controller
 *
 *
 * @method \App\Model\Entity\Rolesacces[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesAccessController extends AppController
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

    public function index($role_id)
    {
        $this->set('page_title', 'Role Access');
        $this->loadModel('Roles');
        $role = $this->Roles->find('all')->where(['id' => $role_id])->first();
        $role_access = $this->paginate(
            $this->RolesAccess->find('all')->where(['role_id' => $role_id])
        );

        if (empty($role)) {
            return $this->redirect(['controller' => 'roles']);
        }

        $role_controllers = [
            'users'
        ];
        $this->set(compact('role'));
        $this->set(compact('role_access'));
        $this->set(compact('role_controllers'));
    }

    public function add($role_id)
    {
        $this->autorender = false;
        $this->autolayout = false;

        if ($this->request->is(['post'])) {
            $current_user = $this->Auth->user('role_id');
            $roles_access = $this->RolesAccess->newEntity(['role_id' => $role_id]);
            $roles_access = $this->RolesAccess->patchEntity($roles_access, $this->request->data);

            if ($roles_result = $this->RolesAccess->save($roles_access)) {
                $this->loggerIt('RoleAccess', 'add', $this->Auth->user('id'), $roles_access, 'Role Access Add'); 
                $this->Flash->formsuccess(__('The role access has been saved.'));
            } else {
                $this->loggerIt('RoleAccess', 'add', $this->Auth->user('id'), $roles_access, 'Role Access Add Failed'); 
                $this->Flash->formerror(__('The role access was not saved.'));
            }
        } else {
            $this->Flash->formerror(__('The role access could not be saved. Please, try again.'));
        }

        $this->redirect($this->referer());
    }


    public function edit($id = null)
    {
        $roles_access = $this->RolesAccess->getAccessRecord($id);

        if ($this->request->is(['post'])) {
            $roles = $this->Auth->user('roles');
            $logged_role = $this->Auth->user('role_id');

            if (!empty($roles)) {
                if (isset($roles['RolesAccess'])) {
                    if ($roles['RolesAccess']['action_edit'] === 1) {
                        if (
                            ($roles_access->role_id > $logged_role)
                            && ($roles_access->role_id != 1)
                        ) { 
                            unset($this->request->data['controller_type']);
                            $roles_access = $this->RolesAccess->patchEntity($roles_access, $this->request->data);
    
                            if ($this->RolesAccess->save($roles_access)) {
                                $this->loggerIt('RoleAccess', 'edit', $this->Auth->user('id'), $roles_access, 'Role Access Edit');
                                $this->Flash->formsuccess(__('Role Access updated.'));
                            } else {
                                $this->loggerIt('RoleAccess', 'edit', $this->Auth->user('id'), $roles_access, 'Role Access Edit Failed');
                                $this->Flash->formerror(__('Role Access was not updated.'));
                            }
                        } else {
                            $this->Flash->formerror(__('You are not authorized to update this role access'));
                        }
                    } else {
                        $this->Flash->formerror(__('You are not authorized to update this role access'));
                    }
                } else {
                    $this->Flash->formerror(__('You are not authorized to update role access'));
                }
            } else {
                $this->Flash->formerror(__('You are not authorized to update this role access'));
            }
            return $this->redirect($this->referer());
        }
        $this->set(compact('roles_access'));
    }

    public function delete($roleaccess_id)
    {
        $this->autorender = false;
        $this->autolayout = false;

        if ($this->request->is(['post'])) {
            $role_access = $this->RolesAccess->get($roleaccess_id);

            if (!empty($role_access)) {
                $logged_role = $this->Auth->user('role_id');
                $logged_roles = $this->Auth->user('roles');

                if ($logged_roles['RolesAccess']['action_delete'] === 1) {
                    if (
                        ($logged_role < $role_access->role_id)
                        && ($role_access->role_id != 1)
                    ) { 
                        if ($this->RolesAccess->delete($role_access)){
                            $this->loggerIt('RolesAccess', 'delete', $this->Auth->user('id'), $role_access, 'Role Access Delete'); 
                            $this->Flash->formsuccess(__('The role status has been updated.'));
                        } else {
                            $this->loggerIt('Roles', 'delete', $this->Auth->user('id'), $role_access, 'Role Access Delete Failed');
                            $this->Flash->RolesAccess(__('The role status was not updated.'));
                        }
                    } else {
                        $this->Flash->formerror(__('You are not authorized to delete this role access.'));
                    }
                } else {
                    $this->Flash->formerror(__('You are not authorized to delete this role access.'));
                }
            } else {
                $this->Flash->formerror(__('Role not found'));
            }
        }

        return $this->redirect(['controller' => 'RolesAccess', 'action' => 'index', $role_access->role_id]);
    }
}
