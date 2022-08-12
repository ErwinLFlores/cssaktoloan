<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConstituentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConstituentsTable Test Case
 */
class ConstituentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConstituentsTable
     */
    public $Constituents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Constituents',
        'app.ConstituentMembers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Constituents') ? [] : ['className' => ConstituentsTable::class];
        $this->Constituents = TableRegistry::getTableLocator()->get('Constituents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Constituents);

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
