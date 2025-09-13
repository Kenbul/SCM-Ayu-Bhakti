<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncomingGoods;

class IncomingGoodsSeeder extends Seeder
{
    public function run(): void
    {
        IncomingGoods::insert([
            [
                'item_id' => 1,
                'supplier_id' => 1,
                'quantity' => 50,
                'date_in' => now()->subDays(10),
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => 2,
                'supplier_id' => 2,
                'quantity' => 100,
                'date_in' => now()->subDays(5),
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
