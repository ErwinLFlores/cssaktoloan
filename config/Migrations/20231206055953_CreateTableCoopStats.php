<?php
use Migrations\AbstractMigration;

class CreateTableCoopStats extends AbstractMigration
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
        $table = $this->table('coop_stats');

        $table->addColumn('status', 'string', [
            'default' => 'active'
        ]);

        $table->addColumn('action', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('action_value', 'datetime', [
            'null' => false,
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
