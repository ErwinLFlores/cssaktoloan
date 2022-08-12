<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RolesAccessTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RolesAccessTable Test Case
 */
class RolesAccessTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RolesAccessTable
     */
    public $RolesAccess;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RolesAccess',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RolesAccess') ? [] : ['className' => RolesAccessTable::class];
        $this->RolesAccess = TableRegistry::getTableLocator()->get('RolesAccess', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RolesAccess);

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
     * Test getRole method
     *
     * @return void
     */
    public function testGetRole()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
