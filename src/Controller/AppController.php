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


        $availableBorrowRequest = $this->availableBorrowRequest();
        $availableBorrowByContribution = $this->availableBorrowByContribution();
        $this->set(compact('availableBorrowRequest', 'availableBorrowByContribution'));
    }

    public function beforeRender(Event $event)
    {
        
    }

    public function getStatus($status_int)
    {
        $statuses = [
            ['grey' => 'For Verification'],
            ['whitesmoke' => 'For Contract Signing'],
            ['lightpink' => 'For User Contract Agreement'],
            ['lightblue' => 'For Release'],
            ['red' => 'Rejected'],
            ['green' => 'Approved and Released'],
            ['grey' => 'Done']
        ];

        return $statuses[$status];
    }

    public function getStatusByIndex($status)
    {
        $statuses = [
            'verification',
            'contract signing',
            'user contract agreement',
            'release',
            'rejected',
            'approved',
            'done',
        ];

        return $statuses[$status];
    }

    public function getStatusIndex($status)
    {
        $statuses = [
            'for verification',
            'for contract signing',
            'user contract agreement',
            'for release',
            'rejected',
            'approved',
            'done',
        ];

        return array_search($status, $statuses);
    }

    public function oneWordStatusIndex($status)
    {
        $statuses = [
            'verification',
            'contract',
            'agreement',
            'release',
            'rejected',
            'approved',
            'done',
        ];

        return array_search($status, $statuses);
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

    public function log_loan_approval_logs($user_id, $message)
    {
        $this->loadModel('LoginLogs');
        $login_logs = $this->LoginLogs->newEntity([
            'user_id' => $user_id,
            'message' => $message,
            'action_provider' => $this->Auth->user('email')
        ]);
        $result = $this->LoginLogs->save($login_logs);
        
        return $result;
    }

    
    public function availableBorrowRequest()
    {
        $this->loadModel('Loans');

        $user_id = $this->Auth->user('id');
        $status = [4, 5, 6, 7];
        $loan = $this->Loans->find('all')->where(
            [
                'user_id' => $user_id,
                'status NOT IN' => $status,
            ]
        )->all();


        return count($loan);
    }

    public function availableBorrowByContribution()
    {
        $this->loadModel('Contributions');

        $user_id = $this->Auth->user('id');

        $contribution = $this->Contributions->find('all')->where(
            [
                'user_id' => $user_id
            ]
        )->all();


        return count($contribution);
    }

}
