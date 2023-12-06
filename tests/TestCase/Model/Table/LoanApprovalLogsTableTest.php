<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LoanApprovalLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LoanApprovalLogsTable Test Case
 */
class LoanApprovalLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LoanApprovalLogsTable
     */
    public $LoanApprovalLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LoanApprovalLogs',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LoanApprovalLogs') ? [] : ['className' => LoanApprovalLogsTable::class];
        $this->LoanApprovalLogs = TableRegistry::getTableLocator()->get('LoanApprovalLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LoanApprovalLogs);

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
