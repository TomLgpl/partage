<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ParConnexionFixture
 */
class ParConnexionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'par_connexion';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'con_utilisateur_lien' => 'e54490fa-fe8a-4603-8a80-3a8bcea567bf',
                'con_horodatage' => 1643279280,
                'con_ip' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
