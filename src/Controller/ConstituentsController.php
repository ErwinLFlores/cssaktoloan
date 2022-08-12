<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Constituents Controller
 *
 * @property \App\Model\Table\ConstituentsTable $Constituents
 *
 * @method \App\Model\Entity\Constituent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConstituentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user());
        $this->loadModel('Categories');
        $this->loadModel('Registry');
        $this->loadModel('ConstituentMembers');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
    }

    public function index($member_search = null)
    {
        $this->set('page_title', 'Manage Constituents Data');
        $search_by_family = $this->Categories->findByMergeValue('search_by_constituents');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_column = $this->request->getQuery('scolumn');
        $searched_conditions = "";

        if (
            (!empty($searched_data))
            && (!empty($searched_column))
        ) {
            $searched_conditions = $searched_column . " LIKE '%" . $searched_data . "%'";
            $this->loggerIt('Constituents', 'search', $this->Auth->user('id'), $searched_conditions, 'Searched Data');
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'page' => 1,
            'order' => ['lastname' => 'ASC']
        );
        $families = $this->paginate('Constituents');
        
        if (
            (!empty($member_search)) 
            && ($member_search == 1)
        ) {
            $this->set('member_search', $member_search);
        }

        $this->set(compact('searched_data'));
        $this->set(compact('searched_column'));
        $this->set(compact('families'));
        $this->set(compact('isPaginated'));
        $this->set(compact('search_by_family'));
    }

    public function members()
    {
        $this->set('page_title', 'Constituents Members Directory');
        $search_by_members = $this->Categories->findByMergeValue('search_by_constituent_members');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_column = $this->request->getQuery('scolumn');
        $searched_conditions = "";

        if (
            (!empty($searched_data))
            && (!empty($searched_column))
        ) {
            $searched_conditions = $searched_column . " LIKE '%" . $searched_data . "%'";
            $this->loggerIt('ConstituentMembers', 'search', $this->Auth->user('id'), $searched_conditions, 'Searched Data');
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'page' => 1,
            'order' => ['fullname' => 'ASC']
        );
        $families = $this->paginate('ConstituentMembers');

        $this->set(compact('searched_data'));
        $this->set(compact('searched_column'));
        $this->set(compact('families'));
        $this->set(compact('isPaginated'));
        $this->set(compact('search_by_members'));
    }
}
