<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KeepersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KeepersTable Test Case
 */
class KeepersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\KeepersTable
     */
    public $Keepers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Keepers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Keepers') ? [] : ['className' => KeepersTable::class];
        $this->Keepers = TableRegistry::getTableLocator()->get('Keepers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Keepers);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
