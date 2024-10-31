<?php

namespace Database\Seeders;

use App\Models\PageCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageCategory::create([
            'slug' => 'test',
            'title' => 'Test Sayfa',
            'meta_description' => 'Example meta description',
            'list_type' => 'grid',
        ]);
        PageCategory::create([
            'slug' => 'test2',
            'title' => 'Test2 Sayfa',
            'meta_description' => 'Example meta description',
            'list_type' => 'list',
        ]);
    }
}
