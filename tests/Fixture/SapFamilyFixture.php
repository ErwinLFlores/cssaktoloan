<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SapFamilyFixture
 */
class SapFamilyFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sap_family';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'family_serial' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fullname' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'gender' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'MALE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'civil_status' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'SINGLE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'birthdate' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'mobile_number' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'id_card' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NOT SPECIFIED', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'id_number' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NOT SPECIFIED', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'house_type' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'OWNER', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'house_number' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NOT SPECIFIED', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'purok' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NOT SPECIFIED', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sitio' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NOT SPECIFIED', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'street' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NOT SPECIFIED', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'barangay' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'BALIBAGO', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'ANGELES', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'province' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'PAMPANGA', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'region' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'CENTRAL LUZON', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sector' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => '0 - NONE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'work' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NONE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'place_of_work' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NONE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'monthly_salary' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NONE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'health_condition' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => '0 - NONE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ethnic_group' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NONE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'beneficiary' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'NONE', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'number_of_family_members' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'picture' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null],
        'card_picture' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'last_modified_by' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_0900_ai_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'family_serial' => 'Lorem ipsum dolor sit amet',
                'fullname' => 'Lorem ipsum dolor sit amet',
                'gender' => 'Lorem ipsum dolor sit amet',
                'civil_status' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'birthdate' => '2022-02-03',
                'mobile_number' => 'Lorem ipsum dolor sit amet',
                'id_card' => 'Lorem ipsum dolor sit amet',
                'id_number' => 'Lorem ipsum dolor sit amet',
                'house_type' => 'Lorem ipsum dolor sit amet',
                'house_number' => 'Lorem ipsum dolor sit amet',
                'purok' => 'Lorem ipsum dolor sit amet',
                'sitio' => 'Lorem ipsum dolor sit amet',
                'street' => 'Lorem ipsum dolor sit amet',
                'barangay' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'province' => 'Lorem ipsum dolor sit amet',
                'region' => 'Lorem ipsum dolor sit amet',
                'sector' => 'Lorem ipsum dolor sit amet',
                'work' => 'Lorem ipsum dolor sit amet',
                'place_of_work' => 'Lorem ipsum dolor sit amet',
                'monthly_salary' => 'Lorem ipsum dolor sit amet',
                'health_condition' => 'Lorem ipsum dolor sit amet',
                'ethnic_group' => 'Lorem ipsum dolor sit amet',
                'beneficiary' => 'Lorem ipsum dolor sit amet',
                'number_of_family_members' => 1,
                'picture' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'card_picture' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created_by' => 'Lorem ipsum dolor sit amet',
                'last_modified_by' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-02-03 14:42:39',
                'modified' => '2022-02-03 14:42:39',
            ],
        ];
        parent::init();
    }
}
