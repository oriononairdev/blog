<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $labelColors = ['#7578ab', '#f16563', '#cbd5e0', '#f7df1e'];
        $status = ['Draft', 'Archived', 'Published'];
        $types = ['Original', 'Link'];

        return [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'featured_image' => '',
            'status' => Arr::random($status, 1)[0],
            'type' => Arr::random($types, 1)[0],
            'content' => $this->faker->paragraphs($nb = 7, $asText = true).'<p></p>'.$this->faker->randomHtml(2, 4),
            'summary' => $this->faker->paragraphs($nb = 2, $asText = true),
            'category_id' => random_int(1, 4),
            'view_count' => random_int(1, 17468),
            'color' => Arr::random($labelColors, 1)[0],
            'published_at' => $this->faker->dateTime('now'),
            'preview_secret' => \Illuminate\Support\Str::random(10),
        ];
    }
}
