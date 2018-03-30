<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property string $uri
 * @property string $title
 * @property string $slug
 * @property string $header
 * @property string $content
 * @property int $dsp_order
 * @property int $delete_flag
 * @property int $is_active
 * @property int $group_id
 * @property string $author
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property string $link_images
 *
 * @property \App\Model\Entity\Group $group
 */
class Post extends Entity
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
        'header' => true,
        'content' => true,
        'dsp_order' => true,
        'delete_flag' => true,
        'is_active' => true,
        'group_id' => true,
        'author' => true,
        'created' => true,
        'modified' => true,
        'group' => true
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
