<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SapMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SapMembersTable Test Case
 */
class SapMembersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SapMembersTable
     */
    public $SapMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SapMembers',
        'app.SapFamily',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SapMembers') ? [] : ['className' => SapMembersTable::class];
        $this->SapMembers = TableRegistry::getTableLocator()->get('SapMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SapMembers);

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
