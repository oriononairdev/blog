<?php

namespace Database\Seeders;

use Exception;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
        $labelColors = ['#7DD3FC', '#F87171', '#cbd5e0', '#FDE047', '#FDBA74', '#A5B4FC', '#6EE7B7', '#93C5FD'];
        $status = ['Draft', 'Archived', 'Published'];
        $types = ['Original', 'Link'];
        $languages = ['["tr"]', '["en"]', '["tr","en"]'];
        $faker = Faker::create();
        for ($i = 0; $i < 66; $i++) {
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            DB::table('blog_posts')->insert([
                'title' => $title,
                'featured_image' => '',
                'status' => Arr::random($status, 1)[0],
                'lang' => Arr::random($languages, 1)[0],
                'type' => Arr::random($types, 1)[0],
                'content' => $faker->paragraphs($nb = 7, true).'<p></p>'.$faker->randomHtml(2, 4),
                'summary' => $faker->paragraphs($nb = 2, true),
                'category_id' => random_int(1, 6),
                'slug' => Str::slug($title),
                'view_count' => random_int(1, 17468),
                'color' => Arr::random($labelColors, 1)[0],
                'preview_secret' => Str::random(10),
                'external_url' => $faker->url(),
                'tweet_url' => $faker->url(),
                'is_pinned' => $faker->boolean(30),
                'published_at' => $faker->dateTime('now'),
                'created_at' => $faker->dateTime('now'),
                'updated_at' => now(),
            ]);
        }
    }
}
