<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LoansPayments Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Loans
 * @property &\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\LoansPayment get($primaryKey, $options = [])
 * @method \App\Model\Entity\LoansPayment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LoansPayment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LoansPayment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LoansPayment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LoansPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LoansPayment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LoansPayment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LoansPaymentsTable extends Table
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

        $this->setTable('loans_payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Loans', [
            'foreignKey' => 'loans_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->scalar('loan_principal_amount')
            ->maxLength('loan_principal_amount', 45)
            ->allowEmptyString('loan_principal_amount');

        $validator
            ->scalar('loan_interest_amount')
            ->maxLength('loan_interest_amount', 45)
            ->allowEmptyString('loan_interest_amount');

        $validator
            ->scalar('loan_penalty_amount')
            ->maxLength('loan_penalty_amount', 45)
            ->allowEmptyString('loan_penalty_amount');

        $validator
            ->scalar('loan_total_payment')
            ->maxLength('loan_total_payment', 45)
            ->allowEmptyString('loan_total_payment');

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
        $rules->add($rules->existsIn(['loans_id'], 'Loans'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
