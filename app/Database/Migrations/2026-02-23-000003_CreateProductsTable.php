<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
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
            'name'        => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'slug'        => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'unique'     => true,
            ],
            'description' => [
                'type'    => 'LONGTEXT',
                'null'    => true,
            ],
            'sku'         => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'price'       => [
                'type'       => 'DECIMAL',
                'constraint' => [10, 2],
            ],
            'offer_price' => [
                'type'       => 'DECIMAL',
                'constraint' => [10, 2],
                'null'       => true,
            ],
            'brand'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'type'        => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'image'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'stock'       => [
                'type'       => 'INT',
                'constraint' => 9,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
