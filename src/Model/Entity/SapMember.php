<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SapMember Entity
 *
 * @property int $id
 * @property string $family_serial_key
 * @property string $fullname
 * @property string|null $relation
 * @property \Cake\I18n\FrozenDate $birthdate
 * @property string $gender
 * @property string|null $work
 * @property string|null $sector
 * @property string|null $health_condition
 * @property string|null $created_by
 * @property string|null $last_modified_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\SapFamily $sap_family
 */
class SapMember extends Entity
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
        'family_serial_key' => true,
        'fullname' => true,
        'relation' => true,
        'birthdate' => true,
        'gender' => true,
        'work' => true,
        'sector' => true,
        'health_condition' => true,
        'created_by' => true,
        'last_modified_by' => true,
        'created' => true,
        'modified' => true,
        'sap_family' => true,
    ];
}
