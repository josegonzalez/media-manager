<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity.
 *
 * @property int $id
 * @property int $asset_id
 * @property \App\Model\Entity\Asset $asset
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $name
 * @property string $dir
 * @property int $size
 * @property string $type
 * @property string $metadata
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class File extends Entity
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
        '*' => true,
        'id' => false,
    ];
}
