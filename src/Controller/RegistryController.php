<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Registry Controller
 *
 *
 * @method \App\Model\Entity\Registry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistryController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user()); 
        $this->loadModel('Residents');
        $this->loadModel('ResidentMembers');
        $this->loadModel('Constituents');
        $this->loadModel('ConstituentMembers');
        $this->loadModel('Categories');
        date_default_timezone_set('Asia/Manila');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
    }

    public function add()
    {
        $this->set('page_title', 'Registry Add');
        $pre_loader = $this->request->getQuery('sap_serial');
        $registry_serial = $this->generateRegistrySerial();

        if (!empty($pre_loader)) {
            $this->loadModel('SapFamily');
            $sap_data = $this->SapFamily->find('all')
                ->where(['family_serial' => $pre_loader])
                ->first();

            if (!empty($sap_data)) {
                if (
                    (!$this->Residents->hasSapSerialUsers($pre_loader))
                    && (!$this->Constituents->hasSapSerialUsers($pre_loader))
                ) {
                    $this->set('sap_data', $sap_data);
                    $this->Flash->formsuccess(__('Data loaded successfully. No loader for Members.'));
                } else {
                    $this->Flash->formerror(__('SAP Serial already linked from another Registrant'));
                    $this->redirect(['controller' => 'registry', 'action' => 'add']);
                }
            } else {
                $this->Flash->formerror(__('Serial not found'));
                $this->redirect(['controller' => 'registry', 'action' => 'add']);
            }
        }

        if ($this->request->is(['post'])) {
            $this_data = null;
            $this_identifier = $this->request->data['registry_status'];
            $this_table = "";
            $this_table_members = "";
            $part_1 = 1;

            if (!empty($this_identifier)) {
                if ($this_identifier === 'RESIDENT') {
                    $this_table = 'Residents';
                    $this_table_members = 'ResidentMembers';
                } elseif ($this_identifier === 'CONSTITUENT') {
                    $this_table = 'Constituents';
                    $this_table_members = 'ConstituentMembers';
                } else {
                    $part_1 = 0;
                    $this->Flash->formerror(__('Registry Type invalid.'));
                    return $this->redirect($this->referer());
                }

                $this_data = $this->$this_table->newEntity();
                $this_data = $this->$this_table->patchEntity($this_data, $this->request->data);
                $this_data->token = $this->$this_table->generateTableToken();
                $this_data->is_youth = $this->isMemberYouth($this_data->birthdate);
                $this_data->created_by = $this->Auth->user('username');
                $this_data->registry_serial_key = $registry_serial;
                $this_data->last_updated = date('Y-m-d');


                if (isset($this->request->data['loaded_sap_serial'])) {
                    if (
                        (!$this->Residents->hasSapSerialUsers($this->request->data['loaded_sap_serial']))
                        && (!$this->Constituents->hasSapSerialUsers($this->request->data['loaded_sap_serial']))
                    ) {
                        $this_data->sap_family_serial = $this->request->data['loaded_sap_serial'];
                    } else {
                        $part_1 = 0;
                        $this->Flash->formerror(__('SAP Serial already linked from another Registrant'));
                        return $this->redirect($this->referer());
                    }
                }
            } else {
                $this->Flash->formerror(__('Registry Type cannot be empty.'));
                return $this->redirect($this->referer());
            }

            if ($part_1 === 1) {
                $this_registry_data = $this->Registry->newEntity([
                    'serial_key' => $this_data->registry_serial_key,
                    'created_by' => $this->Auth->user('username')
                ]);

                if ($this->Registry->save($this_registry_data)) {
                    if ($this->$this_table->save($this_data)) {
                        $this->loggerIt($this_table, 'add', $this->Auth->user('id'), $this_data, $this_table . ' Add');
                        $this->Flash->formsuccess(__('The Data has been registered to the system. Registry Serial: ' 
                            . $this_data->registry_serial_key));
    
                        if (!empty($this->request->data['family_member'])) {
                            $success_counter = 0;
                            $failed_counter = 0;
            
                            foreach ($this->request->data['family_member'] as $key => $member) {
                                $member_data = $this->$this_table_members->newEntity();
                                $member_data = $this->$this_table_members->patchEntity($member_data, [
                                    'resident_id' => $this_data->id,
                                    'constituent_id' => $this_data->id,
                                    'registry_serial_key' => $this_data->registry_serial_key,
                                    'token' => $this->$this_table_members->generateTableMembersToken(),
                                    'firstname' => $member['firstname'],
                                    'middlename' => $member['middlename'],
                                    'lastname' => $member['lastname'],
                                    'relation' => $member['relation'],
                                    'birthdate' => $member['birthdate'],
                                    'gender' => $member['gender'],
                                    'is_youth' => $this->isMemberYouth($member['birthdate']),
                                    'created_by' => $this->Auth->user('username')
                                ]);
                                
                                if ($this->$this_table_members->save($member_data)) {
                                    $this->loggerIt($this_table_members, 'add', $this->Auth->user('id'), 
                                        $member_data, $this_table_members . ' Member Add');
                                    $success_counter += 1;
                                } else {
                                    $this->loggerIt($this_table_members, 'add', $this->Auth->user('id'), 
                                        $member_data, $this_table_members . ' Member Add Failed');
                                    $failed_counter += 1;
                                }
                            }

                            if ($failed_counter > 0) {
                                $this->Flash->formerror(__('Failed to Add ' . strval($failed_counter) . ' Members'));
                            }
                        } 
                    } else {
                        $this->loggerIt($this_table, 'add', $this->Auth->user('id'), $this_data, $this_table . ' Add Failed');
                        $this->Flash->formerror(__('The Data was not registered to the system.'));
                        return $this->redirect($this->referer());
                    }
                } else {
                    $this->loggerIt('Registry', 'generation', $this->Auth->user('id'), $this_registry_data, 'Registry Generation Failed');
                    $this->Flash->formerror(__('Registry Data Generation Failed'));
                    return $this->redirect($this->referer());
                }
                return $this->redirect(['controller' => 'Registry', 'action' => 'add']);
            }
            return $this->redirect($this->referer());
        }

        $this->set('searched_data', $pre_loader);
        $this->set('registry_serial', $registry_serial);
        $this->set('gender', $this->Categories->findByMergeValue('gender'));
        $this->set('civil_status', $this->Categories->findByMergeValue('civil_status'));
        $this->set('registry_status', $this->Categories->findByMergeValue('registry_status'));
    }

    private function generateRegistrySerial($first = 4, $second = 4)
    {
        $characters = '0123456789';
        $characters_v1 = 'ABCDEFGHKMNPRSUVWXYZ';

        do {
            $randomString = '';

            $first_string = '';
            for ($i = 0; $i < $first; ++$i) {
                $first_string .= $characters_v1[rand(0, strlen($characters_v1) - 1)];
            }

            $second_string = '';
            for ($i = 0; $i < $second; ++$i) {
                $second_string .= $characters[rand(0, strlen($characters) - 1)];
            }

            $randomString = $first_string . '-' . $second_string;
        } while ($this->Registry->ifSerialKeyExist($randomString));

        return $randomString;
    }

    private function isMemberYouth($birthDate)
    {
        $currentDate = date("d-m-Y");
        $age = date_diff(date_create($birthDate), date_create($currentDate));
        $current_age = $age->format("%y");

        if (
            ($current_age >= 15)
            && ($current_age <= 30) 
        ) {
            return 1;
        } else {
            return 0;
        }
    }
}