<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property int $event_type_id
 * @property string $title
 * @property string|null $details
 * @property \Cake\I18n\FrozenTime $start
 * @property \Cake\I18n\FrozenTime $end
 * @property int $all_day
 * @property string $status
 * @property string|null $notes
 * @property string|null $created_by
 * @property string|null $last_modified_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \FullCalendar\Model\Entity\EventType $event_type
 */
class Event extends Entity
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
        'event_type_id' => true,
        'title' => true,
        'details' => true,
        'start' => true,
        'end' => true,
        'all_day' => true,
        'status' => true,
        'notes' => true,
        'created_by' => true,
        'last_modified_by' => true,
        'created' => true,
        'modified' => true,
        'event_type' => true,
    ];
}
