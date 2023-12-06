<?php
use Migrations\AbstractMigration;

class CreateTableLoans extends AbstractMigration
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
        $table = $this->table('loans');

        $table->addColumn('user_id', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('terms', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('max_loan_amount', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('approval_user_id', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('auto_debit', 'integer', [
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
