<?php
use Migrations\AbstractMigration;

class CreateTableEventTypes extends AbstractMigration
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
        $table = $this->table('event_types');

        $table->addColumn('name', 'string', [
            'null' => false
        ]);

        $table->addColumn('details', 'text', [
            'null' => true
        ]);

        $table->addColumn('color', 'string', [
            'null' => false
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
