<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Keeper Entity
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
 * @property string|null $keeper_tags
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Keeper extends Entity
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
        'keeper_tags' => true,
        'created' => true,
        'modified' => true,
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
