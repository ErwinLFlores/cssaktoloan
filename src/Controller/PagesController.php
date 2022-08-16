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

        $disk = $this->disk_report();
        $this->set('disk', $disk);

        $this->loadModel('SapFamily');
        $this->loadModel('SapMembers');

        $this->loadModel('Residents');
        $this->loadModel('ResidentMembers');

        $this->loadModel('Constituents');
        $this->loadModel('ConstituentMembers');

        $this->loadModel('LoginLogs');
        $this->loadModel('Logs');

        $this->loadModel('Events');
        $this->loadModel('Users');

        $this->loadModel('Categories');
        $this->loadModel('CategoriesItems');

        $this->set('user_count', $this->Users->find('all')
            ->where(['status' => 1])
            ->count());
        $this->set('user_last_modified', $this->Users->find('all')
            ->order(['modified' => 'DESC'])            
            ->first(1));

        $this->set('category_count', $this->Categories->find('all')
            ->where(['status' => 1])
            ->count());
        $this->set('category_items_count', $this->CategoriesItems->find('all')
            ->where(['status' => 1])
            ->count());

        $this->set('sap_count', $this->SapFamily->find('all')
            ->where(['status' => 1])
            ->count());
        $this->set('sap_members_count', $this->SapMembers->find('all')
            ->count());
        $this->set('sap_last_modified', $this->SapFamily->find('all')
            ->order(['modified' => 'DESC'])            
            ->first(1));

        $this->set('resident_count', $this->Residents->find('all')
            ->where(['status' => 1])
            ->count());
        $this->set('resident_members_count', $this->ResidentMembers->find('all')
            ->count());
        $this->set('resident_last_modified', $this->Residents->find('all')
            ->order(['modified' => 'DESC'])            
            ->first(1));

        $this->set('constituent_count', $this->Constituents->find('all')
            ->where(['status' => 1])
            ->count());
        $this->set('constituent_members_count', $this->ConstituentMembers->find('all')
            ->count());
        $this->set('constituent_last_modified', $this->Constituents->find('all')
            ->order(['modified' => 'DESC'])            
            ->first(1));

        $this->set('event_calendar', $this->Events->find('all')
            ->where(['start >' => date('Y-m-01 00:00:00')])
            ->order(['modified' => 'ASC'])            
            ->all());

        $this->set('login_logs', $this->LoginLogs->find('all')
            ->order(['created' => 'DESC'])            
            ->limit(10));
        $this->set('logs', $this->Logs->find('all')
            ->contain(['Users'])
            ->order(['Logs.created' => 'DESC'])            
            ->limit(20));
    }
}
