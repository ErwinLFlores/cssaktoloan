<?php
use Migrations\AbstractMigration;

class CreateTableUsers extends AbstractMigration
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
        $table = $this->table('users');

        $table->addColumn('status', 'integer', [
            'null' => false,
        ]);
        
        $table->addColumn('username', 'string', [
            'null' => false,
        ]);

        $table->addColumn('password', 'string', [
            'null' => false
        ]);

        $table->addColumn('role_id', 'integer', [
            'null' => false
        ]);

        $table->addColumn('firstname', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('lastname', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('email', 'string', [
            'null' => true,
            'default' => null
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
