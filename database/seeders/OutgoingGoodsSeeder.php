<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OutgoingGoods;

class OutgoingGoodsSeeder extends Seeder
{
    public function run(): void
    {
        OutgoingGoods::insert([
            [
                'item_id' => 1,
                'quantity' => 20,
                'date_out' => now()->subDays(2),
                'destination' => 'Pelanggan Toko A',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => 2,
                'quantity' => 30,
                'date_out' => now()->subDay(),
                'destination' => 'Pelanggan Toko B',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
