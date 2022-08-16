<?php
/*
 * Controllers/EventTypesController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
 
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Event\Event;

/**
 * EventTypes Controller
 *
 * @property \FullCalendar\Model\Table\EventTypesTable $EventTypes
 */
class EventTypesController extends AppController
{
    public $name = 'EventTypes';
    public $paginate = ['limit' => 15];

    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user()); 
        $this->loadModel('Events');
        $this->loadModel('Categories');
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
     * @return void
     */
    public function index()
    {
        $this->set('eventTypes', $this->paginate($this->EventTypes));
        $this->set('_serialize', ['eventTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventType = $this->EventTypes->get($id, [
            'contain' => ['Events']
        ]);
        $this->set('eventType', $eventType);
        $this->set('_serialize', ['eventType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventType = $this->EventTypes->newEntity();
        if ($this->request->is('post')) {
            $eventType = $this->EventTypes->patchEntity($eventType, $this->request->data);
            if ($this->EventTypes->save($eventType)) {
                $this->loggerIt('EventTypes', 'add', $this->Auth->user('id'), $eventType, 'Event Type Add');
                $this->Flash->formsuccess(__('The event type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->loggerIt('EventTypes', 'add', $this->Auth->user('id'), $eventType, 'Event Type Add Failed');
                $this->Flash->formerror(__('The event type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('eventType'));
        $this->set('_serialize', ['eventType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('page_title', 'Manage Events Type');

        $event_type = $this->EventTypes->get($id, [
            'contain' => []
        ]);

        $events = $this->Events->find('all')
            ->where(['event_type_id' => $event_type->id])
            ->contain(['EventTypes']);

        $this->paginate = [
            'limit'   => 12,
            'order'   => ['Events.start' => 'desc']
        ];
        $this->set('events', $this->paginate($events));
        $this->set('_serialize', ['events']);        

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!$id && empty($this->request->data)) {
                $this->Flash->formerror(__('Invalid event type', true));
                $this->redirect(['action' => 'index']);
            }
            if (!empty($this->request->data)) {
                $event_type = $this->EventTypes->patchEntity($event_type, $this->request->data);
                if ($this->EventTypes->save($event_type)) {
                    $this->loggerIt('EventTypes', 'edit', $this->Auth->user('id'), $event_type, 'Event Type Edit');
                    $this->Flash->formsuccess(__('The event type has been saved', true));
                } else {
                    $this->loggerIt('EventTypes', 'edit', $this->Auth->user('id'), $event_type, 'Event Type Edit Failed');
                    $this->Flash->formerror(__('The event type could not be saved. Please, try again.', true));
                }
            }
            if (empty($this->request->data)) {
                $this->request->data = $this->EventTypes->read(null, $id);
            }

            return $this->redirect($this->referer());
        }

        $this->set('account_status', $this->Categories->findByMergeValue('account_status'));
        $this->set(compact('event_type'));
        $this->set('_serialize', ['event_type']);
    }

    public function delete($event_type_id)
    {
        $this->autorender = false;
        $this->autolayout = false;

        if ($this->request->is(['post'])) {
            $event_type = $this->EventTypes->get($event_type_id);
            $updated_status = 0;

            if (!empty($event_type)) {
                $logged_role = $this->Auth->user('role_id');
                $logged_roles = $this->Auth->user('roles');

                if ($logged_roles['EventTypes']['action_delete'] === 1) {
                    if ($event_type->status === 0) {
                        $updated_status = 1;
                    }
                    $event_type->status = $updated_status;

                    if ($this->EventTypes->save($event_type)){
                        $this->loggerIt('EventTypes', 'delete', $this->Auth->user('id'), $event_type, 'Event Type Edit Status (Delete)'); 
                        $this->Flash->formsuccess(__('The event type status has been updated.'));
                    } else {
                        $this->loggerIt('EventTypes', 'delete', $this->Auth->user('id'), $event_type, 'Event Type Edit Status Failed (Delete)');
                        $this->Flash->formsuccess(__('The event type status was not updated.'));
                    }
              
                } else {
                    $this->Flash->formerror(__('You are not authorized to deactivate this event type'));
                }
            } else {
                $this->Flash->formerror(__('Event Type not found'));
            }
        }

        return $this->redirect($this->referer());
    }
}
