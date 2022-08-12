<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $hasAccess;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        date_default_timezone_set('Asia/Manila');

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
    }

    public function beforeFilter(Event $event)
    {
        date_default_timezone_set('Asia/Manila');
        $this->Auth->allow(['index', 'view', 'display']);
    }

    public function beforeRender(Event $event)
    {
        
    }

    public function loggerIt($controller, $action, $user_id, $data = null, $notes = null) 
    {
        $this->loadModel('Logs');
        $logger = $this->Logs->newEntity();
        $logger = $this->Logs->patchEntity($logger, [
            'log_controller' => $controller,
            'log_action' => $action,
            'user_id' => $user_id,
            'notes' => $notes
        ]);

        if (!empty($data)) {
            $logger->data = json_encode($data);
        }

        $this->Logs->save($logger);
    }

    protected function validateAccess($user, $custom_controller = null, $custom_action = null)
    {
        $current_action = $this->request->params;

        if ($custom_controller != null) {
            $current_action['controller'] = $custom_controller;
        }

        if ($custom_action != null) {
            $current_action['action'] = $custom_action;
        }


        if (in_array($current_action['action'], ['feed','cropper', 'camera', 'login', 'logout'])) {
            return true;
        } else {
            if (isset($user['role_id'])) {
                $this->loadModel('RolesAccess');
                $updated_roles = $this->RolesAccess->getAccess($user['role_id']);

                if (empty($updated_roles)) {
                    $this->Flash->error(__('This account is yet modified to have access. Kindly report to admin'));
                } else {
                    if (isset($updated_roles[$current_action['controller']])) {
                        $compared_action = strval('action_' . $current_action['action']);

                        if (isset($updated_roles[$current_action['controller']][$compared_action])) {
                            if ($updated_roles[$current_action['controller']][$compared_action] === 1) {
                                return true;
                            } 
                        } 
                    } 
                }
            }

            $this->log_login_logs($this->Auth->user('username'), 
                'Forced Logout (Unauthorized Page Access)',
                $this->request->clientIp());
            $this->redirect($this->Auth->logout());
            return false;
        }
    }

    public function log_login_logs($username, $message, $ip_address)
    {
        $this->loadModel('LoginLogs');
        $login_logs = $this->LoginLogs->newEntity([
            'username' => $username,
            'message' => $message,
            'ip_address' => $ip_address
        ]);
        $result = $this->LoginLogs->save($login_logs);
        return $result;
    }

    public function passwordChecker($password) 
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(
            (!$uppercase)
            || (!$lowercase) 
            || (!$number) 
            || (!$specialChars) 
            || (strlen($password) < 8)
        ) {
            return false;
        } else {
            return true;
        }
    }

    public function isAuthorized($user)
    {
        $bypass = ['users_add', 'users_login', 'users_logout'];

        $this->loadModel('Roles');
        $this_role_id = $user['role_id'];
        // $current_roles = $this->RolesAccess->getRole($this_role_id);

        // debug($current_roles);exit;

        $this_controller = strtolower($this->request->params['controller']);
        $this_action = strtolower($this->request->params['action']);
        $this_current_action = $this_controller  . "_" . $this_action;

        if (in_array($this_current_action, $bypass)) {

        } elseif (empty($user)) {
            debug('You need to Login to continue');
            exit;
        } else {
            if ($this_role_id === 1) {

            } elseif (isset($current_roles->$this_current_action)) {
                $current_access = $current_roles->$this_current_action;
                if ($current_access == 1) {
                    return true;
                    debug('yow');
                } else {
                    debug('Access not Authorized');
                    exit;
                }
            } elseif (isset($current_roles->$this_controller)) {
                $current_access = $current_roles->$this_controller;
                if ($current_access == 1) {
                    return true;
                    debug('yow');
                } else {
                    debug('Controller Access not Authorized');
                    exit;
                }
            } else { 
                $other_access = $current_roles->others;
                if ($other_access == 1) {
                    return true;
                    debug('yow');
                } else {
                    debug('General Access not Authorized');
                    exit;
                }
            }
        }

    }
}
