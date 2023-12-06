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

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    protected $diskFree;
    protected $diskTotal;

    public function display(...$path)
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    private function disk_report()
    {
        $this->diskFree = disk_free_space ("/");
        $this->diskTotal = disk_total_space ("/");

        $diskFreePercentage = round(($this->diskFree/$this->diskTotal) * 100, 2);
        $diskUsedPercentage = 100 - $diskFreePercentage;

        return [
            'free_disk_converted' => $this->bytesToHuman($this->diskFree),
            'total_disk_converted' => $this->bytesToHuman($this->diskTotal),
            'total_disk_used' => $this->bytesToHuman($this->diskTotal-$this->diskFree),
            'total_free' => $diskFreePercentage . ' %',
            'total_used' => $diskUsedPercentage . ' %'
        ];
    }
 
    private function bytesToHuman($size)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB', 'PB');

        return round(pow(1024, $base - floor($base)), 2) 
            . ' '. $suffixes[floor($base)];
    }

    public function home() 
    {   
        $this->set('page_title', 'Dashboard');

        $this->loadModel('Loans');
        $this->loadModel('Contributions');

        $user_id = $this->Auth->user('id');
        $loan = $this->Loans->find('all')->where(
            [
                'user_id' => $user_id
            ]
        );

        $total_contribution = 0;

        // $total_loan = $loan->sumOf('loan_amount');
        $total_loan = count($loan->all());

        $disk = $this->disk_report();
        $this->set('disk', $disk);

        $logged_name = $this->Auth->user('firstname');

        $this->set(compact([
            'logged_name', 
            'total_loan', 
            'total_contribution'
        ]));
    }

    public function homeplus() 
    {   
        $this->set('page_title', 'Admin Dashboard');

        $disk = $this->disk_report();
        $this->set('disk', $disk);
        $this->set('logged_name', $this->Auth->user('firstname'));

        $this->loadModel('Contributions');
        $this->set('total_contribution', $this->Contributions->find('all')
            ->order(['id' => 'DESC'])
            ->first(1)->total_contributions);

        $this->loadModel('Loans');
        $results = $this->Loans->find('all');
        $results = $results
            ->select([
                'total_loans' => $results->func()->sum('loan_amount')
            ])
            ->where(["status !=" => 4])
            ->first();
        $this->set('total_loan', intval($results->total_loans));

        $this->loadModel('NotificationLogs');
        $loans_notif = $this->NotificationLogs->find('all')
            ->order(['id' => 'DESc'])
            ->limit(5);
        $this->set('loans_notif', $loans_notif);

        $this->loadModel('LoginLogs');
        $login_logs = $this->LoginLogs->find('all')
            ->order(['id' => 'DESc'])
            ->limit(5);
        $this->set('login_logs', $login_logs);

        $for_approval = $this->Loans->find('all');
        $for_approval = $for_approval
            ->select([
                'total' => $for_approval->func()->count('id')
            ])
            ->where(["status" => 0])
            ->first();
        $this->set('for_approval', intval($for_approval->total));

        $for_contract = $this->Loans->find('all');
        $for_contract = $for_contract
            ->select([
                'total' => $for_contract->func()->count('id')
            ])
            ->where(["status" => 1])
            ->first();
        $this->set('for_contract', intval($for_contract->total));

        $for_release = $this->Loans->find('all');
        $for_release = $for_release
            ->select([
                'total' => $for_release->func()->count('id')
            ])
            ->where(["status" => 3])
            ->first();
        $this->set('for_release', intval($for_release->total));

        $approved_loans = $this->Loans->find('all');
        $approved_loans = $approved_loans
            ->select([
                'total' => $approved_loans->func()->count('id')
            ])
            ->where(["status" => 5])
            ->first();
        $this->set('approved_loans', intval($approved_loans->total));

        $rejected_loans = $this->Loans->find('all');
        $rejected_loans = $rejected_loans
            ->select([
                'total' => $rejected_loans->func()->count('id')
            ])
            ->where(["status" => 4])
            ->first();
        $this->set('rejected_loans', intval($rejected_loans->total));

        $this->loadModel('Users');
        $total_users = $this->Users->find('all');
        $total_users = $total_users
            ->select([
                'total' => $total_users->func()->count('id')
            ])
            ->where([
                "status" => 'active',
                "role" => "user"
            ])
            ->first();
        $this->set('total_users', intval($total_users->total));
        
    }
}
