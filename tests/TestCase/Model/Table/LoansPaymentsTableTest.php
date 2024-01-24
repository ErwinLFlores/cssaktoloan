<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LoansPaymentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LoansPaymentsTable Test Case
 */
class LoansPaymentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LoansPaymentsTable
     */
    public $LoansPayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LoansPayments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LoansPayments') ? [] : ['className' => LoansPaymentsTable::class];
        $this->LoansPayments = TableRegistry::getTableLocator()->get('LoansPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LoansPayments);

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
