<?php
use Migrations\AbstractMigration;

class CreateTableSapMembers extends AbstractMigration
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
        $table = $this->table('sap_members');

        $table->addColumn('family_serial_key', 'string', [
            'null' => false,
        ]);

        $table->addColumn('fullname', 'string', [
            'null' => false,
        ]);

        $table->addColumn('relation', 'string', [
            'null' => true,
            'default' => 'NOT SPECIFIED'
        ]);
        
        $table->addColumn('birthdate', 'date', [
            'null' => false,
        ]);

        $table->addColumn('gender', 'string', [
            'null' => false,
            'default'=> 'MALE',
        ]);

        $table->addColumn('work', 'string', [
            'null' => true,
            'default' => 'NOT SPECIFIED'
        ]);

        $table->addColumn('sector', 'string', [
            'null' => true,
            'default' => '0 - NONE'
        ]);

        $table->addColumn('health_condition', 'string', [
            'null' => true,
            'default' => '0 - NONE'
        ]);

        $table->addColumn('created_by', 'string', [
            'null' => true,
            'default' => null
        ]);

        $table->addColumn('last_modified_by', 'string', [
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
