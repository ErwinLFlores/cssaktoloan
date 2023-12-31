<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use PDO;

/**
 * Loans Controller
 *
 * @property \App\Model\Table\LoansTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoansController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user());
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'login', 'logout']);
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        // $this->isAuthorized($this->Auth->user());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $this->loggerIt('Users', 'index', $this->Auth->user('id'));
        $this->set('page_title', 'User List');

    }

    public function viewcontract($loan_id, $process)
    {
        $this->set('page_title', 'For User Contract Loan | Agreement');
        $data = $this->Loans->find('all')
            ->where([
                'Loans.id' => $loan_id,
                'Loans.status' => 2
            ])
            ->contain(['Users'])
            ->first();
        $contract = null;

        if (empty($data)) {
            $this->Flash->formerror(__('Data not Found.'));
            return $this->redirect(['controller' => 'loans', 'action' => 'borrow']);
        } else {
            $this->loadModel('Contracts');
            $contract = $this->Contracts->find('all')
                ->where([
                    'loan_id' => $loan_id,
                    'status' => 'active'
                ])
                ->first();
            $contract = $contract->message;
        }

        $this->set(compact('data'));
        $this->set(compact('contract'));
    }

    public function cancelloan($loan_id, $process)
    {
        $data = $this->Loans->find('all')
            ->where(['id' => $loan_id])
            ->first();
        $data = $this->Loans->patchEntity($data, ['status' => 7]);
        $data = $this->Loans->save($data);
        $message = 'You have cancelled your Loan #' . $data->id . ' request sucessfully.';
        $this->log_loan_approval_logs($data->user_id, $message);
        $this->Flash->error($message);
        
        return $this->redirect(['controller' => 'loans', 'action' => 'borrow']);
    }

    public function agreecontract($loan_id, $process)
    {
        $current_index = $this->oneWordStatusIndex($process);
        $next_index = $this->getStatusByIndex(intval($current_index) + 1);
        $data = $this->Loans->find('all')
            ->where([
                'id' => $loan_id,
                'status' => 2
            ])
            ->first();
        $data = $this->Loans->patchEntity($data, ['status' => 3]);
        
        if ($data = $this->Loans->save($data)) {
            $message = 'You have agreed Loan #' . $data->id . ' contract terms and conditions. Wait for ' 
                . ucwords($next_index) . ' update';
            $this->log_loan_approval_logs($data->user_id, $message);
            $this->Flash->success($message);
                
            return $this->redirect(['controller' => 'loans', 'action' => 'borrow']);
        }
    }

    public function borrow()
    {
        $this->set('page_title', 'Borrow');
        $user_id = $this->Auth->user('id');

        $data = $this->Loans->find('all')->where(
            [
                'user_id' => $user_id
            ]
        )->order(['id' => 'desc'])->all();

        $loan = $this->Loans->find('all')->where(
            [
                'user_id' => $user_id,
                'approval_user_id' => 0,
            ]
        )->first();

        $this->set(compact(['data', 'loan']));
    }

    public function borrowAdd()
    {
        $this->set('page_title', 'Borrow Request');

        $loan = [];
        if ($this->request->is('post')) {
            $this->request->data['user_id']= $this->Auth->user('id');
            $loan = $this->Loans->newEntity();
            $loan = $this->Loans->patchEntity($loan, $this->request->getData());
            if ($this->Loans->save($loan)) {
                $this->Flash->success(__('The borrow request has been saved.'));
                return $this->redirect(['action' => 'borrow']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }

        $this->set('data', $loan);
    }

    public function borrowUpdate($id)
    {
        $this->set('page_title', 'Update Borrow');

        $loan = $this->Loans->find('all')->where(
            [
                'id' => $id,
            ]
        )->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $loan = $this->Loans->patchEntity($loan, $this->request->getData());
            if ($this->Loans->save($loan)) {
                $this->Flash->success(__('The borrow request has been updated.'));
                return $this->redirect(['action' => 'borrow']);
            }
            $this->Flash->error(__('Unable to update the borrow request.'));
        }

        $this->set('loan', $loan);
    }

    public function borrowDelete($id)
    {
        $loan = $this->Loans->get($id);
        if ($this->Loans->delete($loan)) {
            $this->Flash->success(__('The borrow request has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the borrow request.'));
        }
        return $this->redirect(['action' => 'borrow']);
    }

    public function statementofaccount($id)
    {   
        $this->loadModel('LoansPayments');

        $loan = $this->Loans->get($id);

        $loan_payments = $this->LoansPayments->find('all')->where(
            [
                'loans_id' => $id,
            ]
        )->all();

        $this->set(compact(['loan', 'loan_payments']));
    }
}
