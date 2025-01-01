<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
                'name' => 'Baut Body M6X16',
                'description' => 'Baut Body M6X16',
                'stock' => 150000,
                'price' => 250,
                'image' => 'Baut-Body-M6X16.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'U-Clip Mio',
                'description' => 'U-Clip Mio',
                'stock' => 200000,
                'price' => 150,
                'image' => 'U-Clip-Mio.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'U-Clip Vario',
                'description' => 'U-Clip Vario',
                'stock' => 300000,
                'price' => 150,
                'image' => 'U-Clip-Vario.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
