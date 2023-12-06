<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SapFamily Entity
 *
 * @property int $id
 * @property string $family_serial
 * @property string $fullname
 * @property string $gender
 * @property string $civil_status
 * @property int|null $status
 * @property \Cake\I18n\FrozenDate $birthdate
 * @property string $mobile_number
 * @property string|null $id_card
 * @property string|null $id_number
 * @property string|null $house_type
 * @property string|null $house_number
 * @property string|null $purok
 * @property string|null $sitio
 * @property string|null $street
 * @property string $barangay
 * @property string $city
 * @property string $province
 * @property string|null $region
 * @property string|null $sector
 * @property string|null $work
 * @property string|null $place_of_work
 * @property string|null $monthly_salary
 * @property string|null $health_condition
 * @property string|null $ethnic_group
 * @property string|null $beneficiary
 * @property int|null $number_of_family_members
 * @property string|null $picture
 * @property string|null $card_picture
 * @property string|null $created_by
 * @property string|null $last_modified_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class SapFamily extends Entity
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
        'family_serial' => true,
        'fullname' => true,
        'gender' => true,
        'civil_status' => true,
        'status' => true,
        'birthdate' => true,
        'mobile_number' => true,
        'id_card' => true,
        'id_number' => true,
        'house_type' => true,
        'house_number' => true,
        'purok' => true,
        'sitio' => true,
        'street' => true,
        'barangay' => true,
        'city' => true,
        'province' => true,
        'region' => true,
        'sector' => true,
        'work' => true,
        'place_of_work' => true,
        'monthly_salary' => true,
        'health_condition' => true,
        'ethnic_group' => true,
        'beneficiary' => true,
        'number_of_family_members' => true,
        'picture' => true,
        'card_picture' => true,
        'created_by' => true,
        'last_modified_by' => true,
        'created' => true,
        'modified' => true,
    ];
}
