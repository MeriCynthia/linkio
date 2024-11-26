<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TextBlock;

class TextBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TextBlock::factory()->count(5)->create(); // Menggunakan factory
    }
}
