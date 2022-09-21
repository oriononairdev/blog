<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Laravel\Fortify\Features;

it('can render register screen', function () {
    if (! Features::enabled(Features::registration())) {
        return $this->markTestSkipped('Registration support is not enabled.');
    }

    $this->refreshApplicationWithLocale('en');

    $response = $this->get(route('register'));

    $response->assertStatus(200);
});

it('cannot render register if disabled', function () {
    if (Features::enabled(Features::registration())) {
        return $this->markTestSkipped('Registration support is enabled.');
    }
    $this->refreshApplicationWithLocale('en');

    $response = $this->get(route('register'));

    $response->assertStatus(404);
});

it('can register', function () {
    if (! Features::enabled(Features::registration())) {
        return $this->markTestSkipped('Registration support is not enabled.');
    }

    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'twitter_handle' => 'testusertwitter',
    ]);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('can render login screen', function () {
    $this->refreshApplicationWithLocale('en');
    $response = $this->get(route('login'));
    $response->assertStatus(200);
});

it('can login', function () {
    $user = User::factory()->create();
    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('cannot login with wrong password', function () {
    $user = User::factory()->create();
    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);
    $this->assertGuest();
});
