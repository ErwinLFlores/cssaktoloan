<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoopStatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoopStatsTable Test Case
 */
class CoopStatsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CoopStatsTable
     */
    public $CoopStats;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CoopStats',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CoopStats') ? [] : ['className' => CoopStatsTable::class];
        $this->CoopStats = TableRegistry::getTableLocator()->get('CoopStats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoopStats);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
