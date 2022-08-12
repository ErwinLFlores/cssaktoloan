<?php
use Migrations\AbstractMigration;

class CreateTableAccessRoles extends AbstractMigration
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
        $table = $this->table('roles_access');

        $table->addColumn('role_id', 'integer', [
            'null' => false,
        ]);

        $table->addColumn('controller_type', 'string', [
            'null' => false
        ]);

        $table->addColumn('action_view', 'integer', [
            'null' => false
        ]);

        $table->addColumn('action_add', 'integer', [
            'null' => false
        ]);

        $table->addColumn('action_edit', 'integer', [
            'null' => false
        ]);

        $table->addColumn('action_delete', 'integer', [
            'null' => false
        ]);

        $table->addColumn('action_prints', 'integer', [
            'null' => false
        ]);

        $table->addColumn('action_reports', 'integer', [
            'null' => false
        ]);

        $table->addColumn('action_members', 'integer', [
            'null' => false
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
