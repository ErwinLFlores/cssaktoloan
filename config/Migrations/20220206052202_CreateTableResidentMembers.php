<?php
use Migrations\AbstractMigration;

class CreateTableResidentMembers extends AbstractMigration
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
        $table = $this->table('resident_members');

        $table->addColumn('resident_id', 'integer', [
            'null' => false
        ]);

        $table->addColumn('registry_serial_key', 'string', [
            'null' => false
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

        $table->addColumn('relation', 'string', [
            'null' => false
        ]);

        $table->addColumn('gender', 'string', [
            'null' => false
        ]);

        $table->addColumn('birthdate', 'date', [
            'null' => false
        ]);

        $table->addColumn('is_youth', 'integer', [
            'null' => false,
            'default' => 0,
            'comment' => '15 to 30 years old'
        ]);

        $table->addColumn('notes', 'text', [
            'null' => true
        ]);

        $table->addColumn('created_by', 'string', [
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
