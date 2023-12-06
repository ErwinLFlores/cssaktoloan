<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RolesAcces Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $controller_type
 * @property int|null $action_view
 * @property int|null $action_add
 * @property int|null $action_edit
 * @property int|null $action_delete
 * @property int|null $action_prints
 * @property int|null $action_reports
 * @property int|null $action_members
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Role $role
 */
class RolesAcces extends Entity
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
        'role_id' => true,
        'controller_type' => true,
        'action_view' => true,
        'action_add' => true,
        'action_edit' => true,
        'action_delete' => true,
        'action_prints' => true,
        'action_reports' => true,
        'action_members' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
    ];
}
