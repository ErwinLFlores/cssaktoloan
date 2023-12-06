<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoriesItem Entity
 *
 * @property int $id
 * @property string $name
 * @property string $merge_value
 * @property int $category_id
 *
 * @property \App\Model\Entity\Category $category
 */
class CategoriesItem extends Entity
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
        'merge_value' => true,
        'category_id' => true,
        'category' => true,
    ];
}
