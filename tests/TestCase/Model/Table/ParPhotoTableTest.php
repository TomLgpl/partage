<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParPhotoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParPhotoTable Test Case
 */
class ParPhotoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ParPhotoTable
     */
    protected $ParPhoto;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ParPhoto',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ParPhoto') ? [] : ['className' => ParPhotoTable::class];
        $this->ParPhoto = $this->getTableLocator()->get('ParPhoto', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ParPhoto);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ParPhotoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
