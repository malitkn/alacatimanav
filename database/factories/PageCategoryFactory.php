<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageCategory>
 */
class PageCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent' => 0,
            'slug' => fake()->unique()->slug,
            'title' => fake()->name,
            'meta_description' => fake()->text(150),
            'status' => fake()->boolean,
        ];
    }
}
