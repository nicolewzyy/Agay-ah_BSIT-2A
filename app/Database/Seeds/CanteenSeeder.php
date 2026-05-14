<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CanteenSeeder extends Seeder
{
    public function run()
    {
        // Default Admin
        $userData = [
            'username'   => 'admin',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'name'       => 'System Admin',
            'role'       => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('users')->insert($userData);

        // Categories
        $categories = [
            ['name' => 'Meals'],
            ['name' => 'Snacks'],
            ['name' => 'Drinks'],
            ['name' => 'Desserts'],
        ];
        $this->db->table('categories')->insertBatch($categories);

        // Sample Products
        $products = [
            [
                'category_id'    => 1,
                'name'           => 'Rice with Adobo',
                'description'    => 'Classic Filipino Adobo with rice',
                'price'          => 45.00,
                'stock_quantity' => 50,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'category_id'    => 1,
                'name'           => 'Rice with Sinigang',
                'description'    => 'Sour soup with rice',
                'price'          => 45.00,
                'stock_quantity' => 30,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'category_id'    => 2,
                'name'           => 'Banana Cue',
                'description'    => 'Fried caramelized banana',
                'price'          => 15.00,
                'stock_quantity' => 40,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'category_id'    => 3,
                'name'           => 'Iced Tea',
                'description'    => 'Refreshing iced tea',
                'price'          => 10.00,
                'stock_quantity' => 100,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('products')->insertBatch($products);
    }
}
