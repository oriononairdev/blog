@extends('blog.layouts.master')
@section('title'){{ __('blog.contact.title') }}@endsection
@section('page-level-css')@livewireStyles @endsection
@section('content')
    <livewire:blog.contact />
@endsection
@section('page-level-js')<livewire:scripts /> @endsection
