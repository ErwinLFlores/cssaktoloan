<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResidentMember Entity
 *
 * @property int $id
 * @property int $resident_id
 * @property string $registry_serial_key
 * @property string $token
 * @property string $firstname
 * @property string|null $middlename
 * @property string $lastname
 * @property string $relation
 * @property string $gender
 * @property \Cake\I18n\FrozenDate $birthdate
 * @property int $is_youth
 * @property string|null $notes
 * @property string|null $created_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Resident $resident
 */
class ResidentMember extends Entity
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
        'resident_id' => true,
        'registry_serial_key' => true,
        'token' => true,
        'firstname' => true,
        'middlename' => true,
        'lastname' => true,
        'relation' => true,
        'gender' => true,
        'birthdate' => true,
        'is_youth' => true,
        'notes' => true,
        'created_by' => true,
        'created' => true,
        'modified' => true,
        'resident' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token',
    ];
}
