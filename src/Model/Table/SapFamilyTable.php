<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SapFamily Model
 *
 * @method \App\Model\Entity\SapFamily get($primaryKey, $options = [])
 * @method \App\Model\Entity\SapFamily newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SapFamily[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SapFamily|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SapFamily saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SapFamily patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SapFamily[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SapFamily findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SapFamilyTable extends Table
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

        $this->setTable('sap_family');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('family_serial')
            ->maxLength('family_serial', 255)
            ->requirePresence('family_serial', 'create')
            ->notEmptyString('family_serial');

        $validator
            ->scalar('fullname')
            ->maxLength('fullname', 255)
            ->requirePresence('fullname', 'create')
            ->notEmptyString('fullname');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->notEmptyString('gender');

        $validator
            ->scalar('civil_status')
            ->maxLength('civil_status', 255)
            ->notEmptyString('civil_status');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

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
            ->scalar('id_card')
            ->maxLength('id_card', 255)
            ->allowEmptyString('id_card');

        $validator
            ->scalar('id_number')
            ->maxLength('id_number', 255)
            ->allowEmptyString('id_number');

        $validator
            ->scalar('house_type')
            ->maxLength('house_type', 255)
            ->allowEmptyString('house_type');

        $validator
            ->scalar('house_number')
            ->maxLength('house_number', 255)
            ->allowEmptyString('house_number');

        $validator
            ->scalar('purok')
            ->maxLength('purok', 255)
            ->allowEmptyString('purok');

        $validator
            ->scalar('sitio')
            ->maxLength('sitio', 255)
            ->allowEmptyString('sitio');

        $validator
            ->scalar('street')
            ->maxLength('street', 255)
            ->allowEmptyString('street');

        $validator
            ->scalar('barangay')
            ->maxLength('barangay', 255)
            ->notEmptyString('barangay');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->notEmptyString('city');

        $validator
            ->scalar('province')
            ->maxLength('province', 255)
            ->notEmptyString('province');

        $validator
            ->scalar('region')
            ->maxLength('region', 255)
            ->allowEmptyString('region');

        $validator
            ->scalar('sector')
            ->maxLength('sector', 255)
            ->allowEmptyString('sector');

        $validator
            ->scalar('work')
            ->maxLength('work', 255)
            ->allowEmptyString('work');

        $validator
            ->scalar('place_of_work')
            ->maxLength('place_of_work', 255)
            ->allowEmptyString('place_of_work');

        $validator
            ->scalar('monthly_salary')
            ->maxLength('monthly_salary', 255)
            ->allowEmptyString('monthly_salary');

        $validator
            ->scalar('health_condition')
            ->maxLength('health_condition', 255)
            ->allowEmptyString('health_condition');

        $validator
            ->scalar('ethnic_group')
            ->maxLength('ethnic_group', 255)
            ->allowEmptyString('ethnic_group');

        $validator
            ->scalar('beneficiary')
            ->maxLength('beneficiary', 255)
            ->allowEmptyString('beneficiary');

        $validator
            ->integer('number_of_family_members')
            ->allowEmptyString('number_of_family_members');

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

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['family_serial']));
        $rules->add($rules->isUnique(['family_serial', 'mobile_number']));

        return $rules;
    }

    public function ifSerialKeyExist($code)
    {
        $response = false;
        $results = $this->find('all')
            ->where(['family_serial' => $code])
            ->first();

        if(!empty($results)){
            $response = true;
        }

        return $response;
    }
}
