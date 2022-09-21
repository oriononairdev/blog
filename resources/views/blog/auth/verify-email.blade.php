@extends('blog.layouts.master')
@section('title'){{ __('blog.register.verify-mail.title') }}@endsection
@section('content')
    <div class="-mx-4 sm:mx-0 p-4 sm:p-6 md:p-8 mb-8 bg-gray-100 border-b-5 border-gray-200 text-sm text-gray-700">
        @if (session('status') === 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{__('blog.register.verify-mail.resent')}}
            </div>
        @endif
        <p>{{__('blog.register.verify-mail.info')}}</p>
        <p class="mt-2">{{__('blog.register.verify-mail.info2')}}</p>
        <button
            type="submit"
            form="verify-email-notification"
            class="mt-3 px-3 py-2 text-sm text-white bg-yellow-500 font-semibold border-t-3 border-b-3 border-yellow-700 border-t-transparent"
        >
            {{__('blog.register.verify-mail.resent-button')}}
        </button>

        <form id="verify-email-notification" action="{{ route('verification.send') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
@endsection
