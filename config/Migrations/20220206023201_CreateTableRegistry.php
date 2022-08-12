<?php
use Migrations\AbstractMigration;

class CreateTableRegistry extends AbstractMigration
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
        $table = $this->table('registry');

        $table->addColumn('serial_key', 'string', [
            'null' => false
        ]);

        $table->addColumn('sap_family_serial', 'string', [
            'null' => true,
            'default' => null
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
