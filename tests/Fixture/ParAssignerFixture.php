<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ParAssignerFixture
 */
class ParAssignerFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'par_assigner';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'ass_uti_lien' => '81290c71-3ab0-4d22-8393-4cb3231e2dcc',
                'ass_pho_lien' => 'e5852b12-a5ee-4bc3-a362-0eb3f0ad9d1a',
            ],
        ];
        parent::init();
    }
}
