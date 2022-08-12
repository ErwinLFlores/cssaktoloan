<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Constituent Entity
 *
 * @property int $id
 * @property int $status
 * @property \Cake\I18n\FrozenDate $last_updated
 * @property string $registry_serial_key
 * @property string|null $sap_family_serial
 * @property string $token
 * @property string $firstname
 * @property string|null $middlename
 * @property string $lastname
 * @property string $gender
 * @property string $civil_status
 * @property \Cake\I18n\FrozenDate $birthdate
 * @property string $mobile_number
 * @property int $is_youth
 * @property int|null $resident_key
 * @property string|null $notes
 * @property string|null $created_by
 * @property string|null $last_modified_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ConstituentMember[] $constituent_members
 */
class Constituent extends Entity
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
        'last_updated' => true,
        'registry_serial_key' => true,
        'sap_family_serial' => true,
        'token' => true,
        'firstname' => true,
        'middlename' => true,
        'lastname' => true,
        'gender' => true,
        'civil_status' => true,
        'birthdate' => true,
        'mobile_number' => true,
        'is_youth' => true,
        'resident_key' => true,
        'notes' => true,
        'created_by' => true,
        'last_modified_by' => true,
        'created' => true,
        'modified' => true,
        'constituent_members' => true,
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
