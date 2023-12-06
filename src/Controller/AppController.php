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
        $this->Auth->allow(['index']);
    }

    public function beforeRender(Event $event)
    {
        
    }

    protected function validateAdmin($user)
    {
        if (isset($user['role'])) {
            if ($user['role'] === 'admin') {
                $this->redirect(['controller' => 'pages', 'action' => 'homeplus']);

                return true;
            } else if ($user['role'] === 'user') {
                $this->redirect(['controller' => 'pages', 'action' => 'home']);

                return false;
            }  
            else $this->redirect($this->Auth->logout());
        } 
    }

    protected function validateAccess($user)
    {
        if (isset($user['role'])) {
            return true;
        } else $this->redirect($this->Auth->logout());
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

}
