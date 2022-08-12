<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConstituentMembers Model
 *
 * @property \App\Model\Table\ConstituentsTable&\Cake\ORM\Association\BelongsTo $Constituents
 *
 * @method \App\Model\Entity\ConstituentMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConstituentMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConstituentMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConstituentMember|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConstituentMember saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConstituentMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConstituentMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConstituentMember findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConstituentMembersTable extends Table
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

        $this->setTable('constituent_members');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Constituents', [
            'foreignKey' => 'constituent_id',
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
            ->scalar('registry_serial_key')
            ->maxLength('registry_serial_key', 255)
            ->requirePresence('registry_serial_key', 'create')
            ->notEmptyString('registry_serial_key');

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
            ->scalar('relation')
            ->maxLength('relation', 255)
            ->requirePresence('relation', 'create')
            ->notEmptyString('relation');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmptyDate('birthdate');

        $validator
            ->integer('is_youth')
            ->notEmptyString('is_youth');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->scalar('created_by')
            ->maxLength('created_by', 255)
            ->allowEmptyString('created_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['constituent_id'], 'Constituents'));

        return $rules;
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

    public function generateTableMembersToken($length = 60)
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
