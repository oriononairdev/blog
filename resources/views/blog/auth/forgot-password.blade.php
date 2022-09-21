@extends('blog.layouts.master')
@section('title'){{ __('blog.forgot-password.title') }}@endsection
@section('content')
    <div class="markup mb-8">
        <h1>{{ __('blog.forgot-password.page-title') }}</h1>
    </div>

    @include('blog.partials.alerts.simple-errors')

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
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
                <button
                    class="button button-gray"
                    type="submit">{{ __('blog.forgot-password.submit') }}
                </button>
            </div>
        </form>
    </div>
@endsection
