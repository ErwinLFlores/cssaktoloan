<?php
use Migrations\AbstractMigration;

class CreateTableNotificationLogs extends AbstractMigration
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
        $table = $this->table('notification_logs');

        $table->addColumn('username', 'string', [
            'null' => false,
        ]);

        $table->addColumn('message', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('ip_address', 'string', [
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
