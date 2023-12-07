<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Text;

/**
 * Members Controller
 *
 * @property \App\Model\Table\MembersTable $Members
 *
 * @method \App\Model\Entity\Member[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MembersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        // $this->validateAdmin($this->Auth->user());
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
        $this->set('page_title', 'Members List');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_conditions = "role = 'user'";

        if (!empty($searched_data)) {
            $searched_conditions .=  "AND (email LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR firstname LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR lastname LIKE '%" . $searched_data . "%')";
        }
        
        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'page' => 1,
            'order' => ['id' => 'DESC']
        );
        $members = $this->paginate('Users');
        
        if (
            (!empty($member_search)) 
            && ($member_search == 1)
        ) {
            $this->set('member_search', $member_search);
        }

        $this->set(compact('members'));
        $this->set(compact('searched_data'));
        $this->set(compact('isPaginated'));
    }
}

