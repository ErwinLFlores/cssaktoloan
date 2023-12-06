<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Text;

/**
 * Contributions Controller
 *
 *
 * @method \App\Model\Entity\Contribution[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContributionsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
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
        $this->set('page_title', 'Contributions List');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_conditions = "";

        if (!empty($searched_data)) {
            $searched_conditions =  "email LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR firstname LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR lastname LIKE '%" . $searched_data . "%'";
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'contain' => ['Users'],
            'page' => 1,
            'order' => ['id' => 'DESC']
        );
        $contributions = $this->paginate('Contributions');
        
        if (
            (!empty($member_search)) 
            && ($member_search == 1)
        ) {
            $this->set('member_search', $member_search);
        }

        $this->set(compact('contributions'));
        $this->set(compact('searched_data'));
        $this->set(compact('isPaginated'));
    }

    /**
     * View method
     *
     * @param string|null $id Contribution id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contribution = $this->Contributions->get($id, [
            'contain' => [],
        ]);

        $this->set('contribution', $contribution);
    }
}
