<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_colors')->insert([
            [
                'name' => 'Red',
                'description' => 'Bright Red Color',
                'hex_code' => '#FF0000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blue',
                'description' => 'Deep Blue Color',
                'hex_code' => '#0000FF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Green',
                'description' => 'Fresh Green Color',
                'hex_code' => '#00FF00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Black',
                'description' => 'Classic Black Color',
                'hex_code' => '#000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'White',
                'description' => 'Pure White Color',
                'hex_code' => '#FFFFFF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yellow',
                'description' => 'Bright Yellow Color',
                'hex_code' => '#FFFF00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Purple',
                'description' => 'Royal Purple Color',
                'hex_code' => '#800080',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pink',
                'description' => 'Soft Pink Color',
                'hex_code' => '#FFC0CB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orange',
                'description' => 'Vibrant Orange Color',
                'hex_code' => '#FFA500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gray',
                'description' => 'Neutral Gray Color',
                'hex_code' => '#808080',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brown',
                'description' => 'Earthy Brown Color',
                'hex_code' => '#A52A2A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cyan',
                'description' => 'Bright Cyan Color',
                'hex_code' => '#00FFFF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Magenta',
                'description' => 'Bold Magenta Color',
                'hex_code' => '#FF00FF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Olive',
                'description' => 'Muted Olive Color',
                'hex_code' => '#808000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
