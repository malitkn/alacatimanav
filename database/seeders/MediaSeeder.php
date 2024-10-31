<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Media::create(
            [
                'section' => 'header',
                'path' => Storage::url('nav-log2-white.png')
            ]
        );

        Media::create(
            [
                'section' => 'footer',
                'path' => Storage::url('nav-log2-white.png')
            ]
        );
    }
}
