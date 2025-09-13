<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::insert([
            [
                'name' => 'PT Sumber Makmur',
                'contact' => '08123456789',
                'address' => 'Jl. Merdeka No. 123, Medan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CV Maju Jaya',
                'contact' => '08234567890',
                'address' => 'Jl. Sudirman No. 45, Kisaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
