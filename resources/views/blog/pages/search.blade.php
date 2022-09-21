@extends('blog.layouts.master')
@section('title'){{ __('blog.search.title') }}@endsection
@section('page-level-css')@livewireStyles @endsection
@section('content')
    <div class="markup mb-4">
        <h1>{{ __('blog.search.title') }}</h1>
    </div>
    <livewire:blog.search/>
@endsection
@section('page-level-js')<livewire:scripts /> @endsection
