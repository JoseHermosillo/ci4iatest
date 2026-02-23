<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductUserSeeder extends Seeder
{
    public function run()
    {
        // Assign all products to user_id 1 (admin user)
        $this->db->table('products')
            ->where('user_id IS NULL', null, false)
            ->update(['user_id' => 1]);
    }
}
