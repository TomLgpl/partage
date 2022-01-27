<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParConnexionTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParConnexionTable Test Case
 */
class ParConnexionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ParConnexionTable
     */
    protected $ParConnexion;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ParConnexion',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ParConnexion') ? [] : ['className' => ParConnexionTable::class];
        $this->ParConnexion = $this->getTableLocator()->get('ParConnexion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ParConnexion);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ParConnexionTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
