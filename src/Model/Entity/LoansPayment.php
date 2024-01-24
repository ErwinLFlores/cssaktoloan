<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LoansPayment Entity
 *
 * @property int $id
 * @property int|null $loans_id
 * @property int|null $user_id
 * @property string|null $loan_principal_amount
 * @property string|null $loan_interest_amount
 * @property string|null $loan_penalty_amount
 * @property string|null $loan_total_payment
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class LoansPayment extends Entity
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
        'loans_id' => true,
        'user_id' => true,
        'loan_principal_amount' => true,
        'loan_interest_amount' => true,
        'loan_penalty_amount' => true,
        'loan_total_payment' => true,
        'created' => true,
        'modified' => true,
    ];
}
