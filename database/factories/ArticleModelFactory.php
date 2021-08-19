<?php

namespace Database\Factories;

use App\Models\ArticleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticleModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'category_model_id' => mt_rand(1, 2),
            'user_id' => mt_rand(1, 10),
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            'body' => collect($this->faker->paragraphs(mt_rand(10, 25)))->map(function($p){
                return "<p>$p</p>";
            })->implode(''),
            // 'body' => '<p>' .implode('</p><p>', $this->faker->paragraphs(mt_rand(10, 25))). '</p>',
            // 'body' => collect($this->faker->paragraphs(mt_rand(10, 25)))->map(fn($p) => "<p>$p</p>")->implode(''),
        ];
    }
}
