<?php
/*
 * Controller/EventsController.php
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
 * Events Controller
 *
 * @property \FullCalendar\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user()); 
        $this->loadModel('Categories');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
    }

    public $name = 'Events';
    public $paginate = ['limit' => 15];
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('page_title', 'Manage Events');
        $events = $this->Events->find('all')->contain(['EventTypes']);

        if ($this->request->is('requested')) {
            $this->paginate = [
                'limit'   => 2,
                'order'   => ['Events.start' => 'desc']
            ];
            $this->response->body(json_encode($this->paginate($events)));
            return $this->response;
        } else {
            $this->paginate = [
                'limit'   => 12,
                'order'   => ['Events.start' => 'desc']
            ];
            $this->set('events', $this->paginate($events));
            $this->set('_serialize', ['events']);            
        }

        $this->set('event_status', $this->Categories->findByMergeValue('event_status'));
        $this->set('event_types', $this->Events->EventTypes->find('all')->all());
    }

    public function view($id, $back_id = null)
    {
        $this->set('page_title', 'View Event');
        $event = $this->Events->get($id, [
            'contain' => ['EventTypes']
        ]);

        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        if (!empty($back_id)) {
            $this->set('back_id', $back_id);
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $event = $this->Events->newEntity();
            $event = $this->Events->patchEntity($event, $this->request->data);
            $event->created_by = $this->Auth->user('username');

            if ($this->Events->save($event)) {
                $this->loggerIt('Events', 'add', $this->Auth->user('id'), $event, 'Events Add');
                $this->Flash->formsuccess(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->loggerIt('Events', 'add', $this->Auth->user('id'), $event, 'Events Add Failed');
                $this->Flash->formerror(__('The event could not be saved. Please, try again.'));
            }
        }
        $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('page_title', 'Edit Event');
        $event = $this->Events->get($id, ['contain' => ['EventTypes']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            $event->last_modified_by = $this->Auth->user('username');

            if ($event_id = $this->Events->save($event)) {
                $this->loggerIt('Events', 'edit', $this->Auth->user('id'), $event, 'Events Add');
                $this->Flash->formsuccess(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->loggerIt('Events', 'edit', $this->Auth->user('id'), $event, 'Events Failed');
                $this->Flash->formerror(__('The event could not be saved. Please, try again.'));
            }
        }
        $this->set('event_status', $this->Categories->findByMergeValue('event_status'));
        $this->set('event_types', $this->Events->EventTypes->find('all')->all());
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->loggerIt('Events', 'delete', $this->Auth->user('id'), $event, 'Events Delete');
            $this->Flash->formsuccess(__('The event has been deleted.'));
        } else {
            $this->loggerIt('Events', 'delete', $this->Auth->user('id'), $event, 'Events Delete Failed');
            $this->Flash->formerror(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    // The feed action is called from "webroot/js/ready.js" to get the list of events (JSON)
    public function feed($id=null)
    {
        $this->viewBuilder()->layout('ajax');
        $vars = $this->request->query([]);
        $conditions = ['UNIX_TIMESTAMP(start) >=' => $vars['start'], 
            'UNIX_TIMESTAMP(start) <=' => $vars['end']];
        $events = $this->Events->find('all', $conditions)->contain(['EventTypes']);
        $this->loggerIt('Events', 'feed', $this->Auth->user('id'), $events, 'Events Feed Load (Calendar)');

        foreach($events as $event) {
            if($event->all_day === 1) {
                $allday = true;
                $end = $event->start;
            } else {
                $allday = false;
                $end = $event->end;
            }
            $json[] = (object) [
                'id' => $event->id,
                'title'=> $event->title,
                'start'=> $event->start,
                'end' => $end,
                'allDay' => $allday,
                'url' => Router::url(['action' => 'view', $event->id]),
                'details' => nl2br(h($event->details)),
                'status' => $event->status,
                'color' => $event->event_type->color
            ];
        }

        $this->set(compact('json'));
        $this->set('_serialize', 'json');
    }

    // The update action is called from "webroot/js/ready.js" to update date/time when an event is dragged or resized
    public function update($id = null)
    {
        $this->loggerIt('Events', 'drag', $this->Auth->user('id'), $event, 'Events Feed Load Drag');
        if ($this->request->is('ajax')) {
            $this->request->accepts('application/json');
            $debuggedData = debug($this->request->data);
            $event = $this->Events->get($id);
            $event = $this->Events->patchEntity($event, $this->request->data);
            $this->Events->save($event);
            $this->set(compact('event'));
            $this->response->body(json_encode($this->request->data));
            return $this->response;
        }
    }
}