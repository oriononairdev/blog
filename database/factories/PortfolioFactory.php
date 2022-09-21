<?php

namespace Database\Factories;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class PortfolioFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Portfolio $project) {
            //
        })->afterCreating(function (Portfolio $project) {
            //
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = ucfirst($this->faker->words(2, true));
        // To add tags in en like in love set locale to en
        App::setLocale('en');

        return [
            'type' => $this->faker->unique()->jobTitle(),
            'type->tr' => $this->faker->unique()->jobTitle(),
            'title' => $title,
            'title->tr' => $this->faker->words(2, true),
            'summary' => $this->faker->paragraphs(1, true),
            'summary->tr' => $this->faker->paragraphs(1, true),
            'description' => $this->faker->paragraphs(3, true),
            'description->tr' => $this->faker->paragraphs(3, true),
            'slug' => Str::slug($title),
            'color' => $this->faker->hexColor(),
            'published_at' => $this->faker->dateTimeThisDecade(),
            'links->project' => $this->faker->unique()->url(),
            'links->github' => $this->faker->unique()->url(),
            'is_pinned' => $this->faker->boolean(20),
            'is_published' => $this->faker->boolean(40),
            'preview_secret' => \Illuminate\Support\Str::random(10),
            'tags' => $this->faker->words(7),
        ];
    }
}
