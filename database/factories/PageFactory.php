<?php

namespace Database\Factories;

use App\Models\PageCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => PageCategory::find(rand(1, 15)),
            'slug' => fake()->unique()->slug,
            'title' => fake()->unique()->name,
            'meta_description' => fake()->unique()->text('150'),
            'content' => fake()->text(500),
            'thumbnail' => 'images/blog1.png',
            'image' => 'images/blog-page3.png',
            'status' => fake()->boolean,
        ];
    }
}
