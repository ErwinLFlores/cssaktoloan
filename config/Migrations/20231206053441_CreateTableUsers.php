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

        $table->addColumn('status', 'string', [
            'default' => 'active'
        ]);

        $table->addColumn('role', 'string', [
            'null' => false,
        ]);

        $table->addColumn('firstname', 'string', [
            'null' => false,
        ]);
        
        $table->addColumn('lastname', 'string', [
            'null' => false,
        ]);

        $table->addColumn('email', 'string', [
            'null' => false,
        ]);
        
        $table->addColumn('token', 'string', [
            'null' => false,
        ]);

        $table->addColumn('public_token', 'string', [
            'null' => false,
        ]);

        $table->addColumn('password', 'string', [
            'null' => false,
        ]);
        
        $table->addColumn('esign1', 'string', [
            'null' => false,
        ]);

        $table->addColumn('initial_membership_fee', 'integer', [
            'null' => true,
        ]);

        $table->addColumn('monthly_contribution_amount', 'integer', [
            'null' => false,
            'default' => 200,
        ]);

        $table->addColumn('total_contribution_amount', 'integer', [
            'null' => false,
            'default' => 0
        ]);

        $table->addColumn('total_contribution_count', 'integer', [
            'null' => false,
            'default' => 0
            // if less 4, borrow disabled
        ]);

        $table->addColumn('last_contribution_id', 'integer', [
            'null' => false,
            'default' => 0
        ]);

        $table->addColumn('total_withdraw_amount', 'integer', [
            'null' => false,
            'default' => 0
        ]);

        $table->addColumn('regularization_date', 'date', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('user_tags', 'text', [
            'null' => true,
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
