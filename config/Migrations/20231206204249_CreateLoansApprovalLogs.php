<?php
use Migrations\AbstractMigration;

class CreateLoansApprovalLogs extends AbstractMigration
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
        $table = $this->table('loan_approval_logs');

        $table->addColumn('user_id', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('message', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('action_provider', 'string', [
            'null' => false,
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
