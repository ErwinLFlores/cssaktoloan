<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventType Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $details
 * @property string $color
 * @property string|null $notes
 * @property string|null $created_by
 * @property string|null $last_modified_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \FullCalendar\Model\Entity\Event[] $events
 */
class EventType extends Entity
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
        'name' => true,
        'details' => true,
        'color' => true,
        'notes' => true,
        'created_by' => true,
        'last_modified_by' => true,
        'created' => true,
        'modified' => true,
        'events' => true,
    ];
}
