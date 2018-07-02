<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Translate Entity
 *
 * @property int $id
 * @property string $message
 * @property string $note
 * @property string $lang_en
 * @property string $lang_vi
 * @property int $dsp_order
 * @property int $is_active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Translate extends Entity
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
        'message' => true,
        'note' => true,
        'lang_en' => true,
        'lang_vi' => true,
        'dsp_order' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true
    ];
}
