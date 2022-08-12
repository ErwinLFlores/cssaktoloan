<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Registry Entity
 *
 * @property int $id
 * @property string $serial_key
 * @property string|null $sap_family_serial
 * @property string|null $notes
 * @property string|null $created_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Registry extends Entity
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
        'serial_key' => true,
        'sap_family_serial' => true,
        'notes' => true,
        'created_by' => true,
        'created' => true,
        'modified' => true,
    ];
}
