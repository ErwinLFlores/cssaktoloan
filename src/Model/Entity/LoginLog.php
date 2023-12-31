<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LoginLog Entity
 *
 * @property int $id
 * @property string $username
 * @property string|null $message
 * @property string|null $ip_address
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class LoginLog extends Entity
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
        'username' => true,
        'message' => true,
        'ip_address' => true,
        'created' => true,
        'modified' => true,
    ];
}
