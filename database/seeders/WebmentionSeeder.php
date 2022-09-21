<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Webmention;
use Illuminate\Database\Seeder;

class WebmentionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogPost::each(function (BlogPost $post) {
            Webmention::factory()->times(4)->create([
                'blog_post_id' => $post->id,
            ]);
        });
    }
}
