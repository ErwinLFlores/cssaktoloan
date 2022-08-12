<?php
use Migrations\AbstractMigration;

class CreateTableResidents extends AbstractMigration
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
        $table = $this->table('residents');

        $table->addColumn('status', 'integer', [
            'null' => false,
            'default' => 1
        ]);

        $table->addColumn('last_updated', 'date', [
            'null' => false
        ]);

        $table->addColumn('registry_serial_key', 'string', [
            'null' => false
        ]);

        $table->addColumn('sap_family_serial', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('token', 'string', [
            'null' => false
        ]);

        $table->addColumn('firstname', 'string', [
            'null' => false
        ]);

        $table->addColumn('middlename', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('lastname', 'string', [
            'null' => false
        ]);

        $table->addColumn('gender', 'string', [
            'null' => false
        ]);

        $table->addColumn('civil_status', 'string', [
            'null' => false
        ]);

        $table->addColumn('birthdate', 'date', [
            'null' => false
        ]);

        $table->addColumn('mobile_number', 'string', [
            'null' => false
        ]);

        $table->addColumn('is_youth', 'integer', [
            'null' => false,
            'default' => 0,
            'comment' => '15 to 30 years old'
        ]);

        $table->addColumn('constituent_key', 'integer', [
            'null' => true,
            'comment' => 'constituents id when moved'
        ]);

        $table->addColumn('notes', 'text', [
            'null' => true
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
            'default' => null,
            'null' => false
        ]); 

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false
        ]);

        $table->create();

    }
}
