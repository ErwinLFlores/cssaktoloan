<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Text;

/**
 * Sap Controller
 *
 *
 * @method \App\Model\Entity\Sap[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SapController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user());
        $this->loadModel('SapFamily');
        $this->loadModel('SapMembers');
        $this->loadModel('Categories');
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
        $this->set('page_title', 'Manage SAP');
        $search_by_family = $this->Categories->findByMergeValue('search_by_family');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_column = $this->request->getQuery('scolumn');
        $searched_conditions = "";

        if (
            (!empty($searched_data))
            && (!empty($searched_column))
        ) {
            $searched_conditions = $searched_column . " LIKE '%" . $searched_data . "%'";
            $this->loggerIt('SapFamily', 'search', $this->Auth->user('id'), $searched_conditions, 'Searched Data');
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'page' => 1,
            'order' => ['fullname' => 'ASC']
        );
        $families = $this->paginate('SapFamily');
        
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
        $this->set('page_title', 'SAP Members Directory');
        $search_by_members = $this->Categories->findByMergeValue('search_by_members');
        $isPaginated = true;
        $searched_data = $this->request->getQuery('search');
        $searched_column = $this->request->getQuery('scolumn');
        $searched_conditions = "";

        if (
            (!empty($searched_data))
            && (!empty($searched_column))
        ) {
            $searched_conditions = $searched_column . " LIKE '%" . $searched_data . "%'";
            $this->loggerIt('SapMembers', 'search', $this->Auth->user('id'), $searched_conditions, 'Searched Data');
        }

        $this->paginate = array(
            'conditions' => [$searched_conditions],
            'page' => 1,
            'order' => ['fullname' => 'ASC']
        );
        $families = $this->paginate('SapMembers');

        $this->set(compact('searched_data'));
        $this->set(compact('searched_column'));
        $this->set(compact('families'));
        $this->set(compact('isPaginated'));
        $this->set(compact('search_by_members'));
    }

    public function view($sap_serial)
    {
        $this->set('page_title', 'View Registered SAP');

        $data = $this->SapFamily->find('all')
            ->where(['family_serial' => $sap_serial])
            ->first();

        if (empty($data)) {
            $this->Flash->formerror(__('Data not Found.'));
            return $this->redirect(['controller' => 'Sap', 'action' => 'index']);
        } 

        // Calculate Age
        $birthDate = $data->birthdate;
        $currentDate = date("d-m-Y");
        $age = date_diff(date_create($birthDate), date_create($currentDate));
        $data->age = $age->format("%y");

        $fam_members = $this->SapMembers->find('all')
            ->where(['family_serial_key' => $sap_serial])
            ->all();
        $this->set(compact('data'));
        $this->set(compact('fam_members'));

    }

    public function prints($sap_serial)
    {
        $data = $this->SapFamily->find('all')
            ->where(['family_serial' => $sap_serial])
            ->first();

        if (empty($data)) {
            $this->Flash->formerror(__('Data not Found.'));
            return $this->redirect(['controller' => 'Sap', 'action' => 'index']);
        } 

        // Calculate Age
        $birthDate = $data->birthdate;
        $currentDate = date("d-m-Y");
        $age = date_diff(date_create($birthDate), date_create($currentDate));
        $data->age = $age->format("%y");
        $this->loggerIt('SapFamily', 'prints', $this->Auth->user('id'), $data, 'Print Data');

        $fam_members = $this->SapMembers->find('all')
            ->where(['family_serial_key' => $sap_serial])
            ->all();

        $back_id = $sap_serial;
        $this->set(compact('data'));
        $this->set(compact('back_id'));
        $this->set(compact('fam_members'));
    }

    private function generateRandomString($first = 6, $second = 4, $third = 5)
    {
        $characters = '23456789ABCDEFGHKMNPRTUVWXYZ';
        $charactersLength = strlen($characters);

        do {
            $randomString = '';
            $first_string = '';
            for ($i = 0; $i < $first; ++$i) {
                $first_string .= $characters[rand(0, $charactersLength - 1)];
            }

            $second_string = '';
            for ($i = 0; $i < $second; ++$i) {
                $second_string .= $characters[rand(0, $charactersLength - 1)];
            }

            $third_string = '';
            for ($i = 0; $i < $third; ++$i) {
                $third_string .= $characters[rand(0, $charactersLength - 1)];
            }

            $randomString = $first_string . '-' . $second_string . '-' . $third_string;
        } while ($this->SapFamily->ifSerialKeyExist($randomString));

        return $randomString;
    }

    public function add()
    {
        $this->set('page_title', 'Register SAP Beneficiary');

        $gender = $this->Categories->findByMergeValue('gender');
        $civil_status = $this->Categories->findByMergeValue('civil_status');
        $house_type = $this->Categories->findByMergeValue('house_type');
        $beneficiary = $this->Categories->findByMergeValue('beneficiary');
        $sector = $this->Categories->findByMergeValue('sector');
        $health_condition = $this->Categories->findByMergeValue('health_condition');

        if ($this->request->is(['post'])) {
            $sap_data = $this->SapFamily->newEntity();
            $sap_data = $this->SapFamily->patchEntity($sap_data, $this->request->data);
            $sap_data->fullname = $this->request->data['lastname'] 
                . ', ' . $this->request->data['firstname'] 
                . ' ' . $this->request->data['middlename'];
            $sap_data->family_serial = $this->generateRandomString();
            $sap_data->created_by = $this->Auth->user('username');

            if (!empty($this->request->data['family_member'])) {
                $success_counter = 0;
                $failed_counter = 0;

                foreach ($this->request->data['family_member'] as $key => $member) {
                    $member_data = $this->SapMembers->newEntity();
                    $member_data = $this->SapMembers->patchEntity($member_data, [
                        'family_serial_key' => $sap_data->family_serial,
                        'fullname' => $member['fullname'],
                        'relation' => $member['relation'],
                        'birthdate' => $member['birthdate'],
                        'gender' => $member['gender'],
                        'work' => $member['work'],
                        'sector' => $member['sector'],
                        'health_condition' => $member['health_condition'],
                        'created_by' => $sap_data->created_by
                    ]);

                    if ($this->SapMembers->save($member_data)) {
                        $this->loggerIt('SapMember', 'add', $this->Auth->user('id'), $member_data, 'Member Add');
                        $success_counter += 1;
                    } else {
                        $this->loggerIt('SapMember', 'add', $this->Auth->user('id'), $member_data, 'Member Add Failed');
                        $failed_counter += 1;
                    }

                    if ($failed_counter > 0) {
                        $this->Flash->formerror(__('Failed to Add ' . strval($failed_counter) . ' Members'));
                    }

                    $sap_data->number_of_family_members = $this->SapMembers->find('all')
                        ->where(['family_serial_key' => $sap_data->family_serial])
                        ->count();
                }
            } else {
                $sap_data->number_of_family_members = 1;
            }

            if (!empty($_FILES['picture']['tmp_name'])) {
                $ext = "";
                if ($_FILES['picture']['type'] == 'image/jpeg') {
                    $ext = '.jpg';
                } elseif ($_FILES['picture']['type'] == 'image/png') {
                    $ext = '.png';
                } elseif ($_FILES['picture']['type'] == 'image/gif') {
                    $ext = '.gif';
                }

                $image_slug = Text::slug($sap_data->family_serial).$ext;
                $user_photo_path = 'SAP/user_photo/'.$image_slug;
                if (move_uploaded_file($_FILES['picture']['tmp_name'], WWW_ROOT . $user_photo_path)) {
                    @chmod($user_photo_path, 0777);
                    $sap_data->picture = $user_photo_path;
                } else{
                    $this->Flash->formerror(__('User Photo not moved'));
                }
            }

            if (!empty($_FILES['id_picture']['tmp_name'])) {
                $ext1 = "";
                if ($_FILES['id_picture']['type'] == 'image/jpeg') {
                    $ext1 = '.jpg';
                } elseif ($_FILES['id_picture']['type'] == 'image/png') {
                    $ext1 = '.png';
                } elseif ($_FILES['id_picture']['type'] == 'image/gif') {
                    $ext1 = '.gif';
                }


                $image_slug_1 = Text::slug($sap_data->family_serial).$ext1;
                $id_picture_path =  'SAP/id_picture/'.$image_slug_1;
                if (move_uploaded_file($_FILES['id_picture']['tmp_name'], WWW_ROOT . $id_picture_path)) {
                    @chmod($id_picture_path, 0777);
                    $sap_data->card_picture = $id_picture_path;
                } else {
                    $this->Flash->formerror(__('ID Picture not moved'));
                }
            }

            if ($this->SapFamily->save($sap_data)) {
                $this->loggerIt('SapFamily', 'add', $this->Auth->user('id'), $sap_data, 'Sap Data Add');
                $this->Flash->formsuccess(__('The Data has been registered to the system. Serial Key: ' . $sap_data->family_serial));
                // return $this->redirect(['action' => 'index']);
            } else {
                $this->loggerIt('SapFamily', 'add', $this->Auth->user('id'), $sap_data, 'Sap Data Add Failed');
                $this->Flash->formerror(__('The Data was not registered to the system.'));
            }

            $this->redirect($this->referer());
        }

        $this->set(compact('gender'));
        $this->set(compact('civil_status'));
        $this->set(compact('house_type'));
        $this->set(compact('beneficiary'));
        $this->set(compact('sector'));
        $this->set(compact('health_condition'));

    }

    public function edit($sap_serial)
    {
        $this->set('page_title', 'Edit SAP Beneficiary');

        $data = $this->SapFamily->find('all')
            ->where(['family_serial' => $sap_serial])
            ->first();

        if (empty($data)) {
            $this->Flash->formerror(__('Data not Found.'));
            return $this->redirect(['controller' => 'Sap', 'action' => 'index']);
        } 

        $fam_members = $this->SapMembers->find('all')
            ->where(['family_serial_key' => $sap_serial])
            ->all();

        $gender = $this->Categories->findByMergeValue('gender');
        $civil_status = $this->Categories->findByMergeValue('civil_status');
        $house_type = $this->Categories->findByMergeValue('house_type');
        $beneficiary = $this->Categories->findByMergeValue('beneficiary');
        $sector = $this->Categories->findByMergeValue('sector');
        $health_condition = $this->Categories->findByMergeValue('health_condition');

        if ($this->request->is(['post'])) {
            $stored_picture = $data->picture;
            $stored_card_picture = $data->card_picture;
            $sap_data = $this->SapFamily->patchEntity($data, $this->request->data);
            $sap_data->last_modified_by = $this->Auth->user('username');

            $this->SapMembers->deleteAll(['family_serial_key' => $sap_data->family_serial]);
            $this->loggerIt('SapMember', 'edit', $this->Auth->user('id'), 'Delete All Members for Edit', 'Member Remove All on Edit');

            if (!empty($this->request->data['family_member'])) {
                // Clearout member
                $success_counter = 0;
                $failed_counter = 0;

                foreach ($this->request->data['family_member'] as $key => $member) {
                    $member_data = $this->SapMembers->newEntity();
                    $member_data = $this->SapMembers->patchEntity($member_data, [
                        'family_serial_key' => $sap_data->family_serial,
                        'fullname' => $member['fullname'],
                        'relation' => $member['relation'],
                        'birthdate' => $member['birthdate'],
                        'gender' => $member['gender'],
                        'work' => $member['work'],
                        'sector' => $member['sector'],
                        'health_condition' => $member['health_condition'],
                        'created_by' => $sap_data->created_by
                    ]);

                    if ($this->SapMembers->save($member_data)) {
                        $this->loggerIt('SapMember', 'edit', $this->Auth->user('id'), $member_data, 'Member Add');
                        $success_counter += 1;
                    } else {
                        $this->loggerIt('SapMember', 'edit', $this->Auth->user('id'), $member_data, 'Member Add Failed');
                        $failed_counter += 1;
                    }

                    if ($failed_counter > 0) {
                        $this->Flash->formerror(__('Failed to Add ' . strval($failed_counter) . ' Members'));
                    }

                    $sap_data->number_of_family_members = $this->SapMembers->find('all')
                        ->where(['family_serial_key' => $sap_data->family_serial])
                        ->count();
                }
            } else {
                $sap_data->number_of_family_members = 1;
            }

            if (!empty($_FILES['picture']['tmp_name'])) {
                $ext = "";
                if ($_FILES['picture']['type'] == 'image/jpeg') {
                    $ext = '.jpg';
                } elseif ($_FILES['picture']['type'] == 'image/png') {
                    $ext = '.png';
                } elseif ($_FILES['picture']['type'] == 'image/gif') {
                    $ext = '.gif';
                }

                $image_slug = Text::slug($sap_data->family_serial).$ext;
                $user_photo_path = 'SAP/user_photo/'.$image_slug;
                if (move_uploaded_file($_FILES['picture']['tmp_name'], WWW_ROOT . $user_photo_path)) {
                    @chmod($user_photo_path, 0777);
                    $sap_data->picture = $user_photo_path;
                } else{
                    $this->Flash->formerror(__('User Photo not moved'));
                }
            } else {
                $sap_data->picture = $stored_picture;
            }

            if (!empty($_FILES['id_picture']['tmp_name'])) {
                $ext1 = "";
                if ($_FILES['id_picture']['type'] == 'image/jpeg') {
                    $ext1 = '.jpg';
                } elseif ($_FILES['id_picture']['type'] == 'image/png') {
                    $ext1 = '.png';
                } elseif ($_FILES['id_picture']['type'] == 'image/gif') {
                    $ext1 = '.gif';
                }


                $image_slug_1 = Text::slug($sap_data->family_serial).$ext1;
                $id_picture_path =  'SAP/id_picture/'.$image_slug_1;
                if (move_uploaded_file($_FILES['id_picture']['tmp_name'], WWW_ROOT . $id_picture_path)) {
                    @chmod($id_picture_path, 0777);
                    $sap_data->card_picture = $id_picture_path;
                } else {
                    $this->Flash->formerror(__('ID Picture not moved'));
                }
            } else {
                $sap_data->card_picture = $stored_card_picture;
            }

            if ($this->SapFamily->save($sap_data)) {
                $this->loggerIt('SapFamily', 'edit', $this->Auth->user('id'), $sap_data, 'Sap Data Edit');
                $this->Flash->formsuccess(__('The Data has been updated. Serial Key: ' . $sap_data->family_serial));
                // return $this->redirect(['action' => 'index']);
            } else {
                $this->loggerIt('SapFamily', 'edit', $this->Auth->user('id'), $sap_data, 'Sap Data Edit Failed');
                $this->Flash->formerror(__('The Data was not registered to the system.'));
            }

            $this->redirect($this->referer());
        }

        $this->set(compact('data'));
        $this->set(compact('fam_members'));
        $this->set(compact('sap_serial'));
        $this->set(compact('gender'));
        $this->set(compact('civil_status'));
        $this->set(compact('house_type'));
        $this->set(compact('beneficiary'));
        $this->set(compact('sector'));
        $this->set(compact('health_condition'));
    }

}
