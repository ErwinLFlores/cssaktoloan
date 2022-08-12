<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Tools Controller
 *
 *
 * @method \App\Model\Entity\Tool[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class ToolsController extends AppController
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
   
    public function cropper()
    {
        $this->set('page_title', 'Tools > Image Cropper');
    }

    public function camera()
    {
        $this->set('page_title', 'Tools > Camera');
    }

    public function saveimage()
    {

    }
}