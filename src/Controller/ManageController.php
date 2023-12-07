<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Text;

/**
 * Manage Controller
 *
 *
 * @method \App\Model\Entity\Manage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ManageController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Loans');
        // $this->validateAdmin($this->Auth->user());
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {

    }

    public function loans($member_search = null)
    {
        $this->set('page_title', 'Loans List');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_conditions = "";

        if (!empty($searched_data)) {
            $searched_conditions =  "Users.email LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Users.firstname LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Users.lastname LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Loans.status LIKE '%" . $this->getStatusIndex(strtolower($searched_data)) . "%'";
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'contain' => ['Users'],
            'page' => 1,
            'order' => ['id' => 'DESC']
        );
        $loans = $this->paginate('Loans');
        
        if (
            (!empty($member_search)) 
            && ($member_search == 1)
        ) {
            $this->set('member_search', $member_search);
        }

        $this->set(compact('loans'));
        $this->set(compact('searched_data'));
        $this->set(compact('isPaginated'));
    }

    public function approval($member_search = null)
    {
        $this->set('page_title', 'For Loan Verification | Approval');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_conditions = "Loans.status = 0";

        if (!empty($searched_data)) {
            $searched_conditions =  "AND (Users.email LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Users.firstname LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Users.lastname LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Loans.status LIKE '%" . $this->getStatusIndex(strtolower($searched_data)) . "%')";
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'contain' => ['Users'],
            'page' => 1,
            'order' => ['id' => 'DESC']
        );
        $loans = $this->paginate('Loans');
        
        if (
            (!empty($member_search)) 
            && ($member_search == 1)
        ) {
            $this->set('member_search', $member_search);
        }

        $this->set(compact('loans'));
        $this->set(compact('searched_data'));
        $this->set(compact('isPaginated'));
    }

    public function approvalview($loan_id)
    {
        $this->set('page_title', 'For Loan Verification | Approval');
        $data = $this->Loans->find('all')
            ->where([
                'Loans.id' => $loan_id,
                'Loans.status' => 0
            ])
            ->contain(['Users'])
            ->first();

        if (empty($data)) {
            $this->Flash->formerror(__('Data not Found.'));
            return $this->redirect(['controller' => 'manage', 'action' => 'approval']);
        } 
        $this->set(compact('data'));
    }

    public function rejectloan($loan_id, $process)
    {
        $current_index = $this->oneWordStatusIndex($process);
        $current_process = $this->getStatusByIndex(intval($current_index));
        $data = $this->Loans->find('all')
            ->where([
                'id' => $loan_id,
                'status !=' => 3
            ])
            ->first();
        $data = $this->Loans->patchEntity($data, ['status' => 4]);
        $data = $this->Loans->save($data);
        $message = 'Loan #' . $data->id . ' has been rejected. ' . $current_process . ' failed.';
        $this->log_loan_approval_logs($data->user_id, $message);
        $this->Flash->error($message);
        
        return $this->redirect(['controller' => 'manage', 'action' => 'contracts']);
    }

    public function verifyloan($loan_id, $process)
    {
        $current_index = $this->oneWordStatusIndex($process);
        $next_index = $this->getStatusByIndex(intval($current_index) + 1);
        $data = $this->Loans->find('all')
            ->where([
                'id' => $loan_id,
                'status' => 0
            ])
            ->first();
        $data = $this->Loans->patchEntity($data, ['status' => 1]);
        $data = $this->Loans->save($data);
        $message = 'Loan #' . $data->id . ' has been verified. Request will proceed to ' . ucwords($next_index);
        $this->log_loan_approval_logs($data->user_id, $message);
        $this->Flash->success($message);
        
        return $this->redirect(['controller' => 'manage', 'action' => 'loans']);
    }

    private function borrowerdata($loan_data)
    {
        $data = "Can you make a contract where: Person A is: ";
        $data .= "the Borrower ";
        $data .= "Loan Amount: PHP $loan_data->loan_amount, ";
        $data .= "Terms of Payment: $loan_data->terms_of_payment Months, ";
        $data .= "Interest: 3.5% per Annum, ";
        $data .= "Mode of Payment: Auto Debit on Payroll (Monthly)";


        $data .= "And the Person B is the Loan Guarantor which is the borrower's current company, ";
        $data .= "Person C is the Authorization Admin, ";
        $data .= "Person E is the validator and approving admin, ";
        $data .= "Person D is the lending coop, ";
        $data .= "Please also add unable to pay will automatically be deducted on the backpay and any other form of the employees last money to received from the company, ";
        $data .= "and Please Add Privacy Data and All rights to the lender reserved, ";
        $data .= "please make it concise and less than 3 thousand characters";

        $data .= "Only make the terms and condition of the contract, no need to put names and blanks.";
        $data .= " Dont Indicate the Insert Signature, i will put it myself";
        $data .= " Dont put comments and notes. And make it html, loan agreement h1 on the middle";

        return $data;
    }

    public function contracts($member_search = null)
    {
        $this->set('page_title', 'For Contract Generation');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_conditions = "Loans.status = 1 ";

        if (!empty($searched_data)) {
            $searched_conditions =  "AND (Users.email LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Users.firstname LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Users.lastname LIKE '%" . $searched_data . "%')";
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'contain' => ['Users'],
            'page' => 1,
            'order' => ['id' => 'DESC']
        );
        $loans = $this->paginate('Loans');
        
        if (
            (!empty($member_search)) 
            && ($member_search == 1)
        ) {
            $this->set('member_search', $member_search);
        }

        $this->set(compact('loans'));
        $this->set(compact('searched_data'));
        $this->set(compact('isPaginated'));
    }

    public function contractview($loan_id)
    {
        $this->loadComponent('ChatGpt');
        $this->set('page_title', 'For Loan AI Contract Generation | Agreement');
        $data = $this->Loans->find('all')
            ->where([
                'Loans.id' => $loan_id,
                'Loans.status' => 1
            ])
            ->contain(['Users'])
            ->first();
        $contract = null;

        if (empty($data)) {
            $this->Flash->formerror(__('Data not Found.'));
            return $this->redirect(['controller' => 'manage', 'action' => 'contracts']);
        } else {
            try {
                

                if (
                    (isset($contract_sample->choices[0]->message->content))
                    && (!empty($contract_sample->choices[0]->message->content))
                ) {
                    $contract_data = $this->ChatGpt->create($this->borrowerdata($data));
                    $contract_sample = json_decode($contract_data);
                    $contract = $contract_sample->choices[0]->message->content;
                } else {
                    $this->loadModel('Contracts');
                    $contract = $this->Contracts->find('all')
                        ->where([
                            'status' => 'active'
                        ])
                        ->first();
                    $contract = $contract->message;
                }
            } catch (\Throwable $th) {

            }
        }

        $this->set(compact('data'));
        $this->set(compact('contract'));
    }

    public function verifycontract($loan_id, $process)
    {
        $current_index = $this->oneWordStatusIndex($process);
        $next_index = $this->getStatusByIndex(intval($current_index) + 1);
        $data = $this->Loans->find('all')
            ->where([
                'id' => $loan_id,
                'status' => 1
            ])
            ->first();
        $data = $this->Loans->patchEntity($data, ['status' => 2]);
        
        if ($data = $this->Loans->save($data)) {
            $this->loadModel('Contracts');
            $contract_data = $this->Contracts->newEntity([
                'status' => 'active',
                'loan_id' => $loan_id,
                'message' => $this->request->data['contract'],
                'requestor' => $this->Auth->user('email')
            ]);

            if ($contract_data = $this->Contracts->save($contract_data)) {
                $message = 'Loan #' . $data->id . ' contract has been made. Request will proceed to ' . ucwords($next_index);
                $this->log_loan_approval_logs($data->user_id, $message);
                $this->Flash->success($message);
                
                return $this->redirect(['controller' => 'manage', 'action' => 'loans']);
            } else {
                $this->Flash->error('Error occured on Admin Generate Contract.');

                return $this->redirect(['controller' => 'manage', 'action' => 'loans']);
            }
        }
 
    }

    public function release($member_search = null)
    {
        $this->set('page_title', 'For Release');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_conditions = "Loans.status = 3 ";

        if (!empty($searched_data)) {
            $searched_conditions =  "AND (Users.email LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Users.firstname LIKE '%" . $searched_data . "%'";
            $searched_conditions .=  " OR Users.lastname LIKE '%" . $searched_data . "%')";
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'contain' => ['Users'],
            'page' => 1,
            'order' => ['id' => 'DESC']
        );
        $loans = $this->paginate('Loans');
        
        if (
            (!empty($member_search)) 
            && ($member_search == 1)
        ) {
            $this->set('member_search', $member_search);
        }

        $this->set(compact('loans'));
        $this->set(compact('searched_data'));
        $this->set(compact('isPaginated'));
    }

    public function releaseview($loan_id)
    {
        $this->set('page_title', 'For Loan Release');
        $data = $this->Loans->find('all')
            ->where([
                'Loans.id' => $loan_id,
                'Loans.status' => 3
            ])
            ->contain(['Users'])
            ->first();
        $contract = null;

        if (empty($data)) {
            $this->Flash->formerror(__('Data not Found.'));
            return $this->redirect(['controller' => 'manage', 'action' => 'release']);
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

    public function verifyrelease($loan_id, $process)
    {
        $data = $this->Loans->find('all')
            ->where([
                'id' => $loan_id,
                'status' => 3
            ])
            ->first();
        $data = $this->Loans->patchEntity($data, ['status' => 5]);
        
        if ($data = $this->Loans->save($data)) {
            $message = 'Loan #' . $data->id . ' has been released. Thank you for your patience!';
            $this->log_loan_approval_logs($data->user_id, $message);
            $this->Flash->success($message);
            
            return $this->redirect(['controller' => 'manage', 'action' => 'loans']);
        }
    }

    public function view($loan_id)
    {
        $this->set('page_title', 'For Loan View');
        $data = $this->Loans->find('all')
            ->where([
                'Loans.id' => $loan_id
            ])
            ->contain(['Users'])
            ->first();
        $contract = null;

        if (empty($data)) {
            $this->Flash->formerror(__('Data not Found.'));
            return $this->redirect(['controller' => 'manage', 'action' => 'loans']);
        } else {
            $this->loadModel('Contracts');
            $contract = $this->Contracts->find('all')
                ->where([
                    'loan_id' => $loan_id,
                    'status' => 'active'
                ])
                ->first();
            
            if (
                (isset($contract->message))
                && (!empty($contract->message))
            ) {
                $contract = $contract->message;
            }
        }
        
        $this->set(compact('data'));
        $this->set(compact('contract'));
    }

}