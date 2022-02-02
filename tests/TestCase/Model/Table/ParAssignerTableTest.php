<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParAssignerTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParAssignerTable Test Case
 */
class ParAssignerTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ParAssignerTable
     */
    protected $ParAssigner;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ParAssigner',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ParAssigner') ? [] : ['className' => ParAssignerTable::class];
        $this->ParAssigner = $this->getTableLocator()->get('ParAssigner', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ParAssigner);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ParAssignerTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
