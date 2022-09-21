@extends('blog.layouts.master')
@section('title'){{ __('blog.reset-password.title') }}@endsection
@section('content')
    <div class="markup mb-8">
        <h1>{{ __('blog.reset-password.page-title') }}</h1>
    </div>

    @include('blog.partials.alerts.simple-errors')

    <div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{request()->route('token')}}">
            <div class="mt-4">
                <label class="block">
                    <span class="text-gray-700">{{ __('blog.login.email') }}</span>
                    <input
                        id="email"
                        type="email"
                        class="form-input mt-1 block w-full"
                        name="email"
                        value=""
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
                    <span class="text-gray-700">{{ __('blog.register.password') }}</span>
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
                <label class="block">
                    <span class="text-gray-700">{{ __('blog.register.password.confirm') }}</span>
                    <input
                        id="password_confirmation"
                        type="password"
                        class="form-input mt-1 block w-full"
                        name="password_confirmation"
                        value=""
                        required
                        autocomplete="password_confirmation"
                        placeholder=""
                    >
                </label>
                <div>

                </div>
            </div>

            <div class="mt-4">
                <button
                    class="button button-gray"
                    type="submit">{{ __('blog.reset-password.submit') }}
                </button>
            </div>
        </form>
    </div>
@endsection
