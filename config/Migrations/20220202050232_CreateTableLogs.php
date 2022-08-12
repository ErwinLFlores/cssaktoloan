<?php
use Migrations\AbstractMigration;

class CreateTableLogs extends AbstractMigration
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
        $table = $this->table('logs');

        $table->addColumn('log_controller', 'string', [
            'null' => false,
        ]);

        $table->addColumn('log_action', 'string', [
            'null' => false,
        ]);

        $table->addColumn('user_id', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('data', 'text', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('notes', 'text', [
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
