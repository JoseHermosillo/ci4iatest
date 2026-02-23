<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductCategoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 9,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_id'  => [
                'type'       => 'INT',
                'constraint' => 9,
                'unsigned'   => true,
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 9,
                'unsigned'   => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_category');
    }

    public function down()
    {
        $this->forge->dropTable('product_category');
    }
}
