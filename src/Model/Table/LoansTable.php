<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Loans Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ApprovalUsersTable&\Cake\ORM\Association\BelongsTo $ApprovalUsers
 * @property \App\Model\Table\AdminApprovalUsersTable&\Cake\ORM\Association\BelongsTo $AdminApprovalUsers
 *
 * @method \App\Model\Entity\Loan get($primaryKey, $options = [])
 * @method \App\Model\Entity\Loan newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Loan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Loan|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Loan saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Loan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Loan[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Loan findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LoansTable extends Table
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

        $this->setTable('loans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ApprovalUsers', [
            'foreignKey' => 'approval_user_id',
        ]);
        $this->belongsTo('AdminApprovalUsers', [
            'foreignKey' => 'admin_approval_user_id',
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
            ->integer('terms_of_payment')
            ->requirePresence('terms_of_payment', 'create')
            ->notEmptyString('terms_of_payment');

        $validator
            ->scalar('loan_amount')
            ->requirePresence('loan_amount', 'create')
            ->notEmptyString('loan_amount');

        $validator
            ->integer('auto_debit')
            ->allowEmptyString('auto_debit');

        $validator
            ->scalar('interest_per_month')
            ->allowEmptyString('interest_per_month');

        $validator
            ->dateTime('user_contract_approval_date')
            ->allowEmptyDateTime('user_contract_approval_date');

        $validator
            ->scalar('finance_auto_debit_status')
            ->maxLength('finance_auto_debit_status', 100)
            ->allowEmptyString('finance_auto_debit_status');

        $validator
            ->integer('status')
            ->notEmptyString('status');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
