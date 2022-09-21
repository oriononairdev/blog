@extends('blog.layouts.master')
@section('title'){{ __('blog.login.title') }}@endsection
@section('content')
    <div class="markup mb-8">
        <h1>{{ __('blog.login.title') }}</h1>
    </div>

    @include('blog.partials.alerts.simple-errors')

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mt-4">
                <label class="block">
                    <span class="text-gray-700">{{ __('blog.login.email') }}</span>
                    <input
                        id="email"
                        type="email"
                        class="form-input mt-1 block w-full"
                        name="email"
                        value="{{old('email') ?? ''}}"
                        required
                        autocomplete="email"
                        placeholder=""
                    >
                </label>
                <div>
                </div>
            </div>
            <div class="mt-4">
                <label class="block">
                    <span class="text-gray-700">{{ __('blog.login.password') }}</span>
                    <input
                        id="password"
                        type="password"
                        class="form-input mt-1 block w-full"
                        name="password"
                        value=""
                        required
                        autocomplete="password"
                        placeholder=""
                    >
                </label>
                <div>
                </div>
            </div>
            <div class="mt-4">
                <label class="flex items-center">

                    <input class="form-checkbox" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <span class="ml-2">{{ __('blog.login.remember-me') }}</span>
                </label>
            </div>

            <div class="mt-6">
                <button
                    class="button button-gray"
                    type="submit">{{ __('blog.login.submit') }}
                </button>

                <span class="text-xs text-gray-700 float-right space-x-4">
                    <a href="https://www.youtube.com/watch?v=jqQfScoJAg4"
                       target="_blank"
                       class="ml-2 hover:text-gray-500" title="Aha dayıya sor">
                        <img src="{{ asset('media/adanali-gaspci.webp') }}" class="inline-flex w-20 aspect-square"
                             alt=""/>
                    </a>

                    <a href="{{ route('password.request') }}" class="ml-2 hover:text-gray-500">
                        {{ __('blog.login.password-reset') }}
                    </a>

                    <a href="{{ route('register') }}" class="ml-2 hover:text-gray-500">
                        {{ __('blog.login.register') }}
                    </a>
                </span>
            </div>
        </form>
    </div>
@endsection
