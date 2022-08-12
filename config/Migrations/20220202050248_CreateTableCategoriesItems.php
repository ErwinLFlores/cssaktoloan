<?php
use Migrations\AbstractMigration;

class CreateTableCategoriesItems extends AbstractMigration
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
        $table = $this->table('categories_items');

        $table->addColumn('status', 'integer', [
            'null' => false,
            'default' => 1,
        ]);

        $table->addColumn('name', 'string', [
            'null' => false,
        ]);

        $table->addColumn('merge_value', 'string', [
            'null' => false,
        ]);

        $table->addColumn('category_id', 'integer', [
            'null' => false,
        ]);

        $table->create();
    }
}
