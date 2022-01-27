<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ParUtilisateur Entity
 *
 * @property string $uti_lien
 * @property string $uti_identifiant
 * @property string $uti_mot_de_passe
 * @property string $uti_nom
 * @property string $uti_prenom
 */
class ParUtilisateur extends Entity
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
        'uti_identifiant' => true,
        'uti_mot_de_passe' => true,
        'uti_nom' => true,
        'uti_prenom' => true,
    ];
}
