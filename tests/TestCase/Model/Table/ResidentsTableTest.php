<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResidentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResidentsTable Test Case
 */
class ResidentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ResidentsTable
     */
    public $Residents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Residents',
        'app.ResidentMembers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Residents') ? [] : ['className' => ResidentsTable::class];
        $this->Residents = TableRegistry::getTableLocator()->get('Residents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Residents);

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
     * Test ifTokenExist method
     *
     * @return void
     */
    public function testIfTokenExist()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test hasSapSerialUsers method
     *
     * @return void
     */
    public function testHasSapSerialUsers()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test generateTableToken method
     *
     * @return void
     */
    public function testGenerateTableToken()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
