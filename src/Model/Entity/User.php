<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $status
 * @property string $role
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $token
 * @property string $public_token
 * @property string $password
 * @property string $esign1
 * @property string|null $initial_membership_fee
 * @property int $total_contribution_amount
 * @property int $total_contribution_id
 * @property int $total_withdraw_amount
 * @property string|null $user_tags
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\TotalContribution $total_contribution
 * @property \App\Model\Entity\Contribution[] $contributions
 */
class User extends Entity
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
        'status' => true,
        'role' => true,
        'firstname' => true,
        'lastname' => true,
        'email' => true,
        'token' => true,
        'public_token' => true,
        'password' => true,
        'esign1' => true,
        'initial_membership_fee' => true,
        'total_contribution_amount' => true,
        'total_contribution_id' => true,
        'total_withdraw_amount' => true,
        'user_tags' => true,
        'created' => true,
        'modified' => true,
        'total_contribution' => true,
        'contributions' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token',
        'password',
    ];
}
