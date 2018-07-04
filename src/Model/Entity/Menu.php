<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $is_active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ParentMenu $parent_menu
 * @property \App\Model\Entity\ChildMenu[] $child_menus
 * @property \App\Model\Entity\Post[] $posts
 */
class Menu extends Entity
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
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'name' => true,
        'slug' => true,
        'description' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true,
        'parent_menu' => true,
        'child_menus' => true,
        'posts' => true
    ];
}
