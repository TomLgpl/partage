<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ParPhoto Entity
 *
 * @property string $pho_lien
 * @property string $pho_nom
 * @property int $pho_annee
 * @property int $pho_mois
 * @property int $pho_jour
 */
class ParPhoto extends Entity
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
        'pho_nom' => true,
        'pho_annee' => true,
        'pho_mois' => true,
        'pho_jour' => true,
    ];
}
