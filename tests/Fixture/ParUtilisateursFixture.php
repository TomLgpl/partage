<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ParUtilisateursFixture
 */
class ParUtilisateursFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'uti_lien' => '15106dec-fd6f-4428-855d-6b65fc1562de',
                'uti_identifiant' => 'Lorem ipsum dolor sit amet',
                'uti_mot_de_passe' => 'Lorem ipsum dolor sit amet',
                'uti_nom' => 'Lorem ipsum dolor sit amet',
                'uti_prenom' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
