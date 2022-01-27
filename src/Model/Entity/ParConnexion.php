<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ParConnexion Entity
 *
 * @property string $con_utilisateur_lien
 * @property \Cake\I18n\FrozenTime $con_horodatage
 * @property string $con_ip
 */
class ParConnexion extends Entity
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
        'con_horodatage' => true,
        'con_ip' => true,
    ];
}
