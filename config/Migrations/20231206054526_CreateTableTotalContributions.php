<?php
use Migrations\AbstractMigration;

class CreateTableTotalContributions extends AbstractMigration
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
        $table = $this->table('contributions');

        $table->addColumn('status', 'string', [
            'default' => 'active'
        ]);

        $table->addColumn('user_id', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('contribution_amount', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('total_contributions', 'integer', [
            'null' => false,
        ]);
        
        $table->addColumn('total_loans', 'integer', [
            'null' => false,
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
