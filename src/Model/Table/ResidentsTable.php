<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Residents Model
 *
 * @property \App\Model\Table\ResidentMembersTable&\Cake\ORM\Association\HasMany $ResidentMembers
 *
 * @method \App\Model\Entity\Resident get($primaryKey, $options = [])
 * @method \App\Model\Entity\Resident newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Resident[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Resident|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Resident saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Resident patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Resident[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Resident findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResidentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('residents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ResidentMembers', [
            'foreignKey' => 'resident_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->date('last_updated')
            ->requirePresence('last_updated', 'create')
            ->notEmptyDate('last_updated');

        $validator
            ->scalar('registry_serial_key')
            ->maxLength('registry_serial_key', 255)
            ->requirePresence('registry_serial_key', 'create')
            ->notEmptyString('registry_serial_key');

        $validator
            ->scalar('sap_family_serial')
            ->maxLength('sap_family_serial', 255)
            ->allowEmptyString('sap_family_serial');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->requirePresence('token', 'create')
            ->notEmptyString('token');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 255)
            ->requirePresence('firstname', 'create')
            ->notEmptyString('firstname');

        $validator
            ->scalar('middlename')
            ->maxLength('middlename', 255)
            ->allowEmptyString('middlename');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 255)
            ->requirePresence('lastname', 'create')
            ->notEmptyString('lastname');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

        $validator
            ->scalar('civil_status')
            ->maxLength('civil_status', 255)
            ->requirePresence('civil_status', 'create')
            ->notEmptyString('civil_status');

        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmptyDate('birthdate');

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 255)
            ->requirePresence('mobile_number', 'create')
            ->notEmptyString('mobile_number');

        $validator
            ->integer('is_youth')
            ->notEmptyString('is_youth');

        $validator
            ->integer('constituent_key')
            ->allowEmptyString('constituent_key');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->scalar('created_by')
            ->maxLength('created_by', 255)
            ->allowEmptyString('created_by');

        $validator
            ->scalar('last_modified_by')
            ->maxLength('last_modified_by', 255)
            ->allowEmptyString('last_modified_by');

        return $validator;
    }

    public function ifTokenExist($token)
    {
        $response = false;
        $results = $this->find('all')
            ->where(['token' => $token])
            ->first();

        if(!empty($results)) {
            $response = true;
        }

        return $response;
    }

    public function hasSapSerialUsers($serial)
    {
        $response = false;
        $results = $this->find('all')
            ->where([
                'sap_family_serial' => $serial,
                'status' => 1
            ])
            ->first();

        if(!empty($results)) {
            $response = true;
        }

        return $response;
    }

    public function generateTableToken($length = 30)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);

        do {
            $randomString = '';
            for ($i = 0; $i < $length; ++$i) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        } while ($this->ifTokenExist($randomString));

        return $randomString;
    }
}
