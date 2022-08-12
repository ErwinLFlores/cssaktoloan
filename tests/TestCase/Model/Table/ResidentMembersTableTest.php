<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResidentMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResidentMembersTable Test Case
 */
class ResidentMembersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ResidentMembersTable
     */
    public $ResidentMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ResidentMembers',
        'app.Residents',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ResidentMembers') ? [] : ['className' => ResidentMembersTable::class];
        $this->ResidentMembers = TableRegistry::getTableLocator()->get('ResidentMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResidentMembers);

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

    /**
     * Test ifTokenExist method
     *
     * @return void
     */
    public function testIfTokenExist()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
