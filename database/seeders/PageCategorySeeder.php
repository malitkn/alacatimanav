<?php

namespace Database\Seeders;

use App\Enums\PageCategoryListType;
use App\Models\PageCategory;
use Database\Factories\PageCategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageCategory::factory(30)->create();
    }
}
