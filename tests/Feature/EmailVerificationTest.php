<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Features;

it('can render verification screen', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $this->refreshApplicationWithLocale('en');

    $response = $this->actingAs($user)->get(route('verification.notice'));

    $response->assertStatus(200);
});

it('can verify email', function () {
    if (! Features::enabled(Features::emailVerification())) {
        return $this->markTestSkipped('Email verification not enabled.');
    }

    $this->refreshApplicationWithLocale('en');

    Event::fake();

    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    $response = $this->actingAs($user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);

    $this->assertTrue($user->fresh()->hasVerifiedEmail());
    $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
});

it('cannot verify with invalid hash', function () {
    if (! Features::enabled(Features::emailVerification())) {
        return $this->markTestSkipped('Email verification not enabled.');
    }

    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($user)->get($verificationUrl);
    $this->assertFalse($user->fresh()->hasVerifiedEmail());
});
