<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Banner Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $uri
 * @property int $is_active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property string $link_images
 */
class Banner extends Entity
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
        'title' => true,
        'slug' => true,
        'uri' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true
    ];

    /**
     * @return string
     */
    protected function _getLinkImages() {
        if (empty($this->uri)) {
            return '/upload/404-not-found.gif';
        }
        return $this->uri;
    }
}
