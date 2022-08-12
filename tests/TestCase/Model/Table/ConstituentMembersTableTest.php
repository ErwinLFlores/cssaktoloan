<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConstituentMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConstituentMembersTable Test Case
 */
class ConstituentMembersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConstituentMembersTable
     */
    public $ConstituentMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ConstituentMembers',
        'app.Constituents',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ConstituentMembers') ? [] : ['className' => ConstituentMembersTable::class];
        $this->ConstituentMembers = TableRegistry::getTableLocator()->get('ConstituentMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConstituentMembers);

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
