<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'Electronics',
                'slug'        => 'electronics',
                'description' => 'Electronic devices and gadgets',
            ],
            [
                'name'        => 'Clothing',
                'slug'        => 'clothing',
                'description' => 'Apparel and fashion items',
            ],
            [
                'name'        => 'Home & Garden',
                'slug'        => 'home-garden',
                'description' => 'Home and garden products',
            ],
            [
                'name'        => 'Sports & Outdoors',
                'slug'        => 'sports-outdoors',
                'description' => 'Sports and outdoor equipment',
            ],
            [
                'name'        => 'Books',
                'slug'        => 'books',
                'description' => 'Books and literature',
            ],
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
