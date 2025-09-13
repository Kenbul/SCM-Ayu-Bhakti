<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::insert([
            [
                'name' => 'Beras Premium 5Kg',
                'category' => 'Sembako',
                'stock' => 100,
                'price' => 75000,
                'expired_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minyak Goreng 1L',
                'category' => 'Sembako',
                'stock' => 200,
                'price' => 15000,
                'expired_at' => now()->addMonths(12),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sabun Mandi',
                'category' => 'Kebutuhan Harian',
                'stock' => 50,
                'price' => 6000,
                'expired_at' => now()->addMonths(24),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
