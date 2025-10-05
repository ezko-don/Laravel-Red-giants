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
        // Safely clear existing products by deleting instead of truncating
        Product::query()->delete();
        
        $products = [
            [
                'name' => 'iPhone 15 Pro Max',
                'description' => 'Latest flagship smartphone with titanium design, A17 Pro chip, and revolutionary camera system. Features 5G connectivity, all-day battery life, and premium build quality.',
                'price' => 1199.99,
                'stock' => 45,
            ],
            [
                'name' => 'MacBook Pro 16" M3',
                'description' => 'Ultimate creative powerhouse with M3 Max chip, 36GB unified memory, and stunning Liquid Retina XDR display. Perfect for developers, designers, and content creators.',
                'price' => 2499.99,
                'stock' => 12,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Industry-leading noise canceling wireless headphones with exceptional sound quality, 30-hour battery life, and premium comfort for all-day listening.',
                'price' => 399.99,
                'stock' => 87,
            ],
            [
                'name' => 'Apple Watch Ultra 2',
                'description' => 'Most rugged and capable Apple Watch with titanium case, precision dual-frequency GPS, and up to 36 hours of battery life. Built for extreme sports and adventures.',
                'price' => 799.99,
                'stock' => 23,
            ],
            [
                'name' => 'PlayStation 5 Pro',
                'description' => 'Next-generation gaming console with enhanced 4K gaming, ray tracing, and lightning-fast SSD. Includes wireless controller and exclusive game library.',
                'price' => 699.99,
                'stock' => 8, // Low stock to show "Only X left" badge
            ],
            [
                'name' => 'Canon EOS R6 Mark II',
                'description' => 'Professional mirrorless camera with 24.2MP full-frame sensor, 8K video recording, and advanced autofocus system. Perfect for photography enthusiasts.',
                'price' => 2499.99,
                'stock' => 0, // Out of stock to show badge
            ],
            [
                'name' => 'iPad Pro 12.9" M2',
                'description' => 'Most advanced iPad with M2 chip, stunning Liquid Retina XDR display, and all-day battery life. Transform your ideas into reality with Apple Pencil support.',
                'price' => 1099.99,
                'stock' => 34,
            ],
            [
                'name' => 'Bose SoundLink Max',
                'description' => 'Premium portable Bluetooth speaker with 360-degree sound, 20-hour battery life, and waterproof design. Perfect for any adventure or home entertainment.',
                'price' => 399.99,
                'stock' => 156,
            ],
            [
                'name' => 'Samsung 4K Curved Monitor',
                'description' => 'Immersive 32-inch curved 4K UHD monitor with HDR support, 144Hz refresh rate, and ultra-wide color gamut. Ideal for gaming and professional work.',
                'price' => 899.99,
                'stock' => 19,
            ],
            [
                'name' => 'AirPods Pro 2nd Gen',
                'description' => 'Next-level AirPods with up to 2x more Active Noise Cancellation, Adaptive Transparency, and personalized Spatial Audio for an immersive listening experience.',
                'price' => 249.99,
                'stock' => 0, // Out of stock to show badge
            ],
            [
                'name' => 'Tesla Model S Plaid Wheel',
                'description' => 'Premium 21-inch forged aluminum wheels designed specifically for Tesla Model S Plaid. Combines lightweight construction with stunning aesthetics.',
                'price' => 4500.00,
                'stock' => 3, // Very low stock
            ],
            [
                'name' => 'Dyson V15 Detect Vacuum',
                'description' => 'Most powerful and intelligent cordless vacuum with laser dust detection, LCD screen, and up to 60 minutes of runtime. Advanced whole-machine filtration.',
                'price' => 749.99,
                'stock' => 67,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
        
        $this->command->info('Created ' . count($products) . ' sample products with varied stock levels and premium descriptions!');
    }
}
