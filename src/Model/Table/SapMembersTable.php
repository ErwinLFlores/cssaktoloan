<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SapMembers Model
 *
 * @method \App\Model\Entity\SapMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\SapMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SapMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SapMember|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SapMember saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SapMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SapMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SapMember findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SapMembersTable extends Table
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

        $this->setTable('sap_members');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SapFamily', [
            'foreignKey' => 'family_serial_key',
            'joinType' => 'INNER',
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
            ->scalar('family_serial_key')
            ->maxLength('family_serial_key', 255)
            ->requirePresence('family_serial_key', 'create')
            ->notEmptyString('family_serial_key');

        $validator
            ->scalar('fullname')
            ->maxLength('fullname', 255)
            ->requirePresence('fullname', 'create')
            ->notEmptyString('fullname');

        $validator
            ->scalar('relation')
            ->maxLength('relation', 255)
            ->allowEmptyString('relation');

        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmptyDate('birthdate');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->notEmptyString('gender');

        $validator
            ->scalar('work')
            ->maxLength('work', 255)
            ->allowEmptyString('work');

        $validator
            ->scalar('sector')
            ->maxLength('sector', 255)
            ->allowEmptyString('sector');

        $validator
            ->scalar('health_condition')
            ->maxLength('health_condition', 255)
            ->allowEmptyString('health_condition');

        $validator
            ->scalar('created_by')
            ->maxLength('created_by', 255)
            ->allowEmptyString('created_by');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        // $rules->add($rules->isUnique(['id']));
        $rules->add($rules->isUnique(['fullname', 'birthdate', 'gender']));
        // $rules->add($rules->existsIn(['family_serial_key'], 'SapFamily'));

        return $rules;
    }
}
