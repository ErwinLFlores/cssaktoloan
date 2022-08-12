<?php
use Migrations\AbstractMigration;

class CreateTableEvents extends AbstractMigration
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
        $table = $this->table('events');

        $table->addColumn('event_type_id', 'integer', [
            'null' => false
        ]);

        $table->addColumn('title', 'string', [
            'null' => false
        ]);

        $table->addColumn('details', 'text', [
            'null' => true
        ]);
        
        $table->addColumn('start', 'datetime', [
            'null' => false
        ]);

        $table->addColumn('end', 'datetime', [
            'null' => false
        ]);

        $table->addColumn('all_day', 'integer', [
            'null' => false,
            'default' => 1
        ]);

        $table->addColumn('status', 'string', [
            'null' => false,
            'default' => 'Scheduled'
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
