<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * WebsiteImage Entity
 *
 * @property int $id
 * @property string $name
 * @property string|resource $picture
 * @property string $ext
 * @property string $uri
 * @property int $size
 * @property int $width
 * @property int $height
 * @property string $mine_type
 * @property int $delete_flag
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
        'size' => true,
        'mine_type' => true,
        'delete_flag' => true,
        'created' => true,
        'modified' => true
    ];

    /**
     * @return string
     */
    protected function _getWebsiteImageUrl() {
        if ($this->id && $this->name) {
            return Router::url("/images/{$this->id}-{$this->name}.{$this->ext}". '?v=' . md5($this->created));
        }
        return '';
    }

    /**
     * @return string
     */
    protected function _getWebsiteImageUrlFull() {
        if ($this->id && $this->name) {
            return Router::url("/images/{$this->id}-{$this->name}.{$this->ext}". '?v=' . md5($this->created), true);
        }
        return '';
    }
}
