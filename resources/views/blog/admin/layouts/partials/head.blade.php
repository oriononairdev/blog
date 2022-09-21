<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@php setlocale(LC_TIME, app()->getLocale());@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>@yield('title')@if(App::environment('local')) [--DEV]@endif</title>
    @yield('page-level-css-initial')
    <link href="{{asset('/css/blog/admin.css')}}" rel="stylesheet">
    @yield('page-level-css')
    <link href="https://twitter.com/oriononair" rel="me">
    @livewireStyles
</head>
