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


    }
}
