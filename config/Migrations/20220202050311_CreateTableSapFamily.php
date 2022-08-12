<?php
use Migrations\AbstractMigration;

class CreateTableSapFamily extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('sap_family');

        $table->addColumn('family_serial', 'string', [
            'null' => false,
        ]);

        $table->addColumn('fullname', 'string', [
            'null' => false,
        ]);

        $table->addColumn('gender', 'string', [
            'null' => false,
            'default'=> 'MALE',
        ]);

        $table->addColumn('civil_status', 'string', [
            'null' => false,
            'default'=> 'SINGLE',
        ]);

        $table->addColumn('status', 'integer', [
            'null' => true,
            'default'=> 1,
        ]);

        $table->addColumn('birthdate', 'date', [
            'null' => false,
        ]);

        $table->addColumn('mobile_number', 'string', [
            'null' => false,
        ]);

        $table->addColumn('id_card', 'string', [
            'null' => true,
            'default' => 'NOT SPECIFIED'
        ]);

        $table->addColumn('id_number', 'string', [
            'null' => true,
            'default' => 'NOT SPECIFIED'
        ]);

        $table->addColumn('house_type', 'string', [
            'null' => true,
            'default'=> 'OWNER',
        ]);

        $table->addColumn('house_number', 'string', [
            'null' => true,
            'default' => 'NOT SPECIFIED'
        ]);

        $table->addColumn('purok', 'string', [
            'null' => true,
            'default' => 'NOT SPECIFIED'
        ]);

        $table->addColumn('sitio', 'string', [
            'null' => true,
            'default' => 'NOT SPECIFIED'
        ]);

        $table->addColumn('street', 'string', [
            'null' => true,
            'default' => 'NOT SPECIFIED'
        ]);

        $table->addColumn('barangay', 'string', [
            'null' => false,
            'default' => 'BALIBAGO'
        ]);

        $table->addColumn('city', 'string', [
            'null' => false,
            'default' => 'ANGELES'
        ]);

        $table->addColumn('province', 'string', [
            'null' => false,
            'default' => 'PAMPANGA'
        ]);

        $table->addColumn('region', 'string', [
            'null' => true,
            'default' => 'CENTRAL LUZON'
        ]);

        $table->addColumn('sector', 'string', [
            'null' => true,
            'default' => '0 - NONE'
        ]);

        $table->addColumn('work', 'string', [
            'null' => true,
            'default' => 'NONE'
        ]);

        $table->addColumn('place_of_work', 'string', [
            'null' => true,
            'default' => 'NONE'
        ]);

        $table->addColumn('monthly_salary', 'string', [
            'null' => true,
            'default' => 'NONE'
        ]);

        $table->addColumn('health_condition', 'string', [
            'null' => true,
            'default' => '0 - NONE'
        ]);
        
        $table->addColumn('ethnic_group', 'string', [
            'null' => true,
            'default' => 'NONE'
        ]);

        $table->addColumn('beneficiary', 'string', [
            'null' => true,
            'default' => 'NONE'
        ]);

        $table->addColumn('number_of_family_members', 'integer', [
            'null' => true,
            'default' => 1
        ]);

        $table->addColumn('picture', 'text', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('card_picture', 'text', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('created_by', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('last_modified_by', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('created', 'datetime', [
            // 'default' => 'CURRENT_TIMESTAMP' => error on migrations staging
            'default' => null,
            'null' => false
        ]); 

        $table->addColumn('modified', 'datetime', [
            // 'default' => 'CURRENT_TIMESTAMP' => error on migrations staging
            'default' => null,
            'null' => false
        ]);

        $table->create();
    }
}
