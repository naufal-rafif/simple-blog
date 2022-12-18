<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $title = fake()->unique()->sentence();
        $slug = Str::slug($title, '-');
        $image = array("article.jpg", "article2.jpg", "article3.jpg");
        $random_image = array_rand($image, 1);
        $imageName = $image[$random_image];
        return [
            'title' => $title,
            'slug' => $slug,
            'writer' => fake()->name(),
            'category_id' => rand(1, 2),
            'image' => $imageName,
            'content' => 'a',
            'status' => rand(0, 1),
            'delete' => rand(0, 1),
            'created_at' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'updated_at' => fake()->dateTimeBetween('-1 week', '+1 week'),
        ];
    }
}
