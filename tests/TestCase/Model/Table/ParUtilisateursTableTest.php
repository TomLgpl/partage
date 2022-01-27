<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParUtilisateursTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParUtilisateursTable Test Case
 */
class ParUtilisateursTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ParUtilisateursTable
     */
    protected $ParUtilisateurs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ParUtilisateurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ParUtilisateurs') ? [] : ['className' => ParUtilisateursTable::class];
        $this->ParUtilisateurs = $this->getTableLocator()->get('ParUtilisateurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ParUtilisateurs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ParUtilisateursTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ParUtilisateursTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
