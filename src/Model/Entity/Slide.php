<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Slide Entity
 *
 * @property int $id
 * @property string $uri
 * @property string $title
 * @property string $slug
 * @property int $delete_flag
 * @property int $is_active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property string $link_images
 */
class Slide extends Entity
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
        'uri' => true,
        'title' => true,
        'slug' => true,
        'delete_flag' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true
    ];

    /**
     * @return string
     */
    protected function _getLinkImages() {
        if (empty($this->uri)) {
            return '/upload/no_image.svg';
        }
        return $this->uri;
    }
}