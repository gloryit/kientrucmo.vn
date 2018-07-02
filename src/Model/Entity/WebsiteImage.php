<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WebsiteImage Entity
 *
 * @property int $id
 * @property string $name
 * @property string|resource $picture
 * @property string $ext
 * @property string $uri
 * @property int $width
 * @property int $height
 * @property string $mine_type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class WebsiteImage extends Entity
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
        'picture' => true,
        'ext' => true,
        'uri' => true,
        'width' => true,
        'height' => true,
        'mine_type' => true,
        'created' => true,
        'modified' => true
    ];
}
