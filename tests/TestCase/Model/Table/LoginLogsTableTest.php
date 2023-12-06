<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LoginLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LoginLogsTable Test Case
 */
class LoginLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LoginLogsTable
     */
    public $LoginLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LoginLogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LoginLogs') ? [] : ['className' => LoginLogsTable::class];
        $this->LoginLogs = TableRegistry::getTableLocator()->get('LoginLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LoginLogs);

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
