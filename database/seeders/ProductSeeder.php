<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Smartphone X1',
                'description' => 'Latest flagship smartphone with advanced camera and processor',
                'price' => 899.99,
                'stock' => 50,
            ],
            [
                'name' => 'Laptop Pro 15"',
                'description' => 'High-performance laptop for professionals and creatives',
                'price' => 1499.99,
                'stock' => 25,
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Premium noise-cancelling wireless headphones',
                'price' => 299.99,
                'stock' => 100,
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Feature-rich smartwatch with health monitoring',
                'price' => 399.99,
                'stock' => 75,
            ],
            [
                'name' => 'Gaming Console',
                'description' => 'Next-generation gaming console with 4K support',
                'price' => 499.99,
                'stock' => 30,
            ],
            [
                'name' => 'Bluetooth Speaker',
                'description' => 'Portable waterproof Bluetooth speaker',
                'price' => 79.99,
                'stock' => 150,
            ],
            [
                'name' => 'Tablet 10"',
                'description' => 'Lightweight tablet perfect for work and entertainment',
                'price' => 329.99,
                'stock' => 60,
            ],
            [
                'name' => 'Digital Camera',
                'description' => 'Professional DSLR camera with multiple lenses',
                'price' => 1299.99,
                'stock' => 20,
            ],
            [
                'name' => 'Power Bank',
                'description' => 'High-capacity portable power bank for all devices',
                'price' => 49.99,
                'stock' => 200,
            ],
            [
                'name' => 'Wireless Charger',
                'description' => 'Fast wireless charging pad for smartphones',
                'price' => 39.99,
                'stock' => 120,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
