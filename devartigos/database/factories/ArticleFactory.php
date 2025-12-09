<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);
        return [
            'owner_id' => User::factory(),
            'title'       => $title,
            'slug'        => Str::slug($title) . '-' . Str::random(5),
            'content'     => fake()->paragraphs(5, true),
            'cover_image' => fake()->optional()->imageUrl(800, 600, 'tech', true),
        ];
    }
}
