<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(5, true),
            'image' => 'dummy.jpg', // Will be replaced in seeder
            'thumbnail' => 'dummy.jpg', // Will be replaced in seeder
            'views' => $this->faker->numberBetween(0, 1000),
            'user_id' => User::where('role', 'admin')->first()->id,
        ];
    }
}
