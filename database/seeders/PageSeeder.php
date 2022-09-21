<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['About', 'Contact', 'Newsletter'];
        $count = 0;
        $faker = Faker::create();
        foreach ($pages as $page) {
            DB::table('blog_pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'content' => $faker->paragraphs($nb = 4, $asText = true),
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $count++;
        }
        DB::table('blog_pages')->insert([
            'setup' => '{"title":false,"description":true,"postlist":true}',
            'title' => 'Originals',
            'description' => 'Bu bölümde benim ürettiğim içerikleri bulabilirsiniz.',
            'slug' => Str::slug('Originals'),
            'order' => $count,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
