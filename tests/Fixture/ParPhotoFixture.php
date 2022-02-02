<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ParPhotoFixture
 */
class ParPhotoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'par_photo';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'pho_lien' => '1e789466-04aa-4a1b-9489-cb8ddeb92a26',
                'pho_nom' => 'Lorem ipsum dolor sit amet',
                'pho_annee' => 1,
                'pho_mois' => 1,
                'pho_jour' => 1,
            ],
        ];
        parent::init();
    }
}
