<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property string $author
 * @property string $uri
 * @property string $company
 * @property string $address
 * @property string $tel
 * @property string $fax
 * @property string $tax_code
 * @property string $email
 * @property string $website
 * @property string $hotline
 * @property int $delete_flag
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property string $link_images
 */
class Contact extends Entity
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
        'author' => true,
        'uri' => true,
        'company' => true,
        'address' => true,
        'tel' => true,
        'fax' => true,
        'tax_code' => true,
        'email' => true,
        'website' => true,
        'hotline' => true,
        'delete_flag' => true,
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
