<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToProducts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('products', [
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'after' => 'id',
                'constraint' => 11,
            ],
        ]);

        // Add foreign key constraint
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('products', 'products_user_id_foreign');
        $this->forge->dropColumn('products', 'user_id');
    }
}
