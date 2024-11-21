<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'image_name' => 'example1.jpg',
                'image' => 'path/to/example1.jpg',
                'mylink_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_name' => 'example2.jpg',
                'image' => 'path/to/example2.jpg',
                'mylink_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}