<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoopStat Entity
 *
 * @property int $id
 * @property string $status
 * @property int $action
 * @property string $action_value
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class CoopStat extends Entity
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
        'action' => true,
        'action_value' => true,
        'created' => true,
        'modified' => true,
    ];
}
