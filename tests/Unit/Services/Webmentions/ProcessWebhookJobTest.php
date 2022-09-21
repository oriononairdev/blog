<?php

namespace Tests\Unit\Services\Webmentions;

use App\Models\BlogPost;
use App\Services\Webmentions\ProcessWebhookJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\WebhookClient\Models\WebhookCall;
use Tests\TestCase;

class ProcessWebhookJobTest extends TestCase
{
    /** @test */
    public function it_can_convert_a_webhook_payload_to_a_webmention()
    {
        DB::table('blog_categories')->insert([
            'name' => 'test',
            'slug' => Str::slug('test'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BlogPost::factory()->create([
            'id' => 1241,
            'category_id' => 1,
        ]);

        $webhookCall = WebhookCall::create([
            'name' => 'webmentions',
            'url' => 'dummy',
            'payload' => $this->getStub('payload.json'),
        ]);

        (new ProcessWebhookJob($webhookCall))->handle();

        $this->assertDatabaseHas('webmentions', [
            'webmention_id' => '642349',
            'blog_post_id' => 1241,
            'type' => 'reply',
            'author_name' => 'Duy Ha Nguyen',
            'author_url' => 'https://twitter.com/DuyNguyenHa',
            'author_photo_url' => 'https://webmention.io/avatar/pbs.twimg.com/ce13341be3d1444d22543bf8601b9c264d1318f6eb46767a77ac5db017bbdebd.png',
            'interaction_url' => 'https://twitter.com/DuyNguyenHa/status/1147126667162165248',
            'text' => 'totally agree with you',
        ]);
    }

    private function getStub(string $name): array
    {
        return json_decode(file_get_contents(__DIR__."/stubs/{$name}"), true);
    }
}
