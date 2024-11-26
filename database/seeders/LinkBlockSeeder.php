<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LinkBlock;

class LinkBlockSeeder extends Seeder
{
    public function run()
    {
        // Data dummy untuk tabel link_blocks
        LinkBlock::create([
            'mylink_id' => 1,
            'link_title' => 'Visit Google',
            'url' => 'https://www.google.com',
        ]);

        LinkBlock::create([
            'mylink_id' => 1,
            'link_title' => 'GitHub Profile',
            'url' => 'https://github.com/example',
        ]);

        LinkBlock::create([
            'mylink_id' => 2,
            'link_title' => 'Laravel Documentation',
            'url' => 'https://laravel.com/docs',
        ]);
    }
}