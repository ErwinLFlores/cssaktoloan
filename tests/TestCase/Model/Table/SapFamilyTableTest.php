<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SapFamilyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SapFamilyTable Test Case
 */
class SapFamilyTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SapFamilyTable
     */
    public $SapFamily;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('SapFamily') ? [] : ['className' => SapFamilyTable::class];
        $this->SapFamily = TableRegistry::getTableLocator()->get('SapFamily', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SapFamily);

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
     * Test ifSerialKeyExist method
     *
     * @return void
     */
    public function testIfSerialKeyExist()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
