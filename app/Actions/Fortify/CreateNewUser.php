<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:55'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'twitter_handle' => ['nullable', 'max:15', 'regex:/^[A-Za-z0-9_]+$/'],
        ], [
            'name.max' => __('blog.register.name-max'),
            'email.email' => __('blog.email.valid'),
            'email.max' => __('blog.register.email-max'),
            'email.unique' => __('blog.register.email.unique'),
            'password.unique' => __('blog.register.email.unique'),
            'password.confirmed' => __('blog.register.password.confirmed'),
            'password.max' => __('blog.register.confirmed'),
            'password.length' => __('blog.register.confirmed'),
            'twitter_handle.max' => __('blog.register.twitter-max'),
            'twitter_handle.regex' => __('blog.register.twitter-regex'),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'twitter_handle' => $input['twitter_handle'],
        ]);
    }
}
