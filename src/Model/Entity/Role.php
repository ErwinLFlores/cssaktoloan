<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property string $title
 * @property int $sap_view
 * @property int $sap_add
 * @property int $sap_edit
 * @property int $sap_delete
 * @property int $sap_print
 * @property int $census_view
 * @property int $census_add
 * @property int $census_edit
 * @property int $census_delete
 * @property int $census_print
 * @property int $users_view
 * @property int $users_add
 * @property int $users_edit
 * @property int $users_delete
 * @property int $others
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User[] $users
 */
class Role extends Entity
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
        '*' => true,
        'id' => false
    ];
}
