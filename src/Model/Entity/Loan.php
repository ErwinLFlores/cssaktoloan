<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Loan Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $terms_of_payment
 * @property string $loan_amount
 * @property int|null $approval_user_id
 * @property int|null $auto_debit
 * @property string|null $interest_per_month
 * @property \Cake\I18n\FrozenTime|null $user_contract_approval_date
 * @property int|null $admin_approval_user_id
 * @property string|null $finance_auto_debit_status
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ApprovalUser $approval_user
 * @property \App\Model\Entity\AdminApprovalUser $admin_approval_user
 */
class Loan extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'terms_of_payment' => true,
        'loan_amount' => true,
        'approval_user_id' => true,
        'auto_debit' => true,
        'interest_per_month' => true,
        'user_contract_approval_date' => true,
        'admin_approval_user_id' => true,
        'finance_auto_debit_status' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'approval_user' => true,
        'admin_approval_user' => true,
    ];
}
