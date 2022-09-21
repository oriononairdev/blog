@extends('blog.layouts.master')
@section('title'){{ __('blog.register.title') }}@endsection
@section('content')
    <div class="markup mb-8">
        <h1>{{ __('blog.register.page-title') }}</h1>
    </div>

    @include('blog.partials.alerts.simple-errors')

    <div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mt-4">
                <label class="block">
                    <span class="text-gray-700">{{ __('blog.register.name') }}</span>
                    <input
                        id="name"
                        type="text"
                        class="form-input mt-1 block w-full"
                        name="name"
                        value="{{old('name') ?? ''}}"
                        required
                        autocomplete="name"
                        placeholder=""
                    >
                </label>
                <div>
                </div>
            </div>

            <div class="mt-4">
                <label class="block">
                    <span class="text-gray-700">{{ __('blog.register.email') }}</span>
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
                    <span class="text-gray-700">{{ __('blog.register.twitter') }}</span>
                    <input
                        id="twitter_handle"
                        type="text"
                        class="form-input mt-1 block w-full"
                        name="twitter_handle"
                        value="{{old('twitter_handle') ?? ''}}"

                        autocomplete="twitter_handle"
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
                    type="submit">{{ __('blog.register.submit') }}
                </button>
            </div>
        </form>
    </div>
@endsection
