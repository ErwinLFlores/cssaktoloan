<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Member Entity
 *
 * @property int $id
 * @property string|null $status
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string|null $password
 * @property string|null $token
 * @property string|null $public_token
 * @property string|null $otp
 * @property string|null $member_tags
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $esign1
 * @property int $monthly_salary
 * @property \Cake\I18n\FrozenDate $regularization_date
 */
class Member extends Entity
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
        'firstname' => true,
        'lastname' => true,
        'password' => true,
        'token' => true,
        'public_token' => true,
        'otp' => true,
        'member_tags' => true,
        'created' => true,
        'modified' => true,
        'esign1' => true,
        'monthly_salary' => true,
        'regularization_date' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token',
    ];
}
