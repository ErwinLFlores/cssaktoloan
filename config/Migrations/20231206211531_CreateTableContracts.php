<?php
use Migrations\AbstractMigration;

class CreateTableContracts extends AbstractMigration
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
        $table = $this->table('contracts');

        $table->addColumn('status', 'string', [
            'null' => false,
            'default' => 'active'
        ]);

        $table->addColumn('loan_id', 'string', [
            'null' => false,
        ]);

        $table->addColumn('message', 'text', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('requestor', 'string', [
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
