@extends('blog.layouts.master')
@section('title','Terminal')
@section('page-level-css')
    <link href="{{ mix('css/blog/xterm.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="mb-5" style="
        height: 6px;
        background-color: #f16563;
        box-shadow: 0 3px 0 #f16563dd, 0 3px 0 #000;
        "></div>
    <div id="terminal" class=""></div>
    @include('blog.auth.logout-form')
@endsection
@section('page-level-js')
    <script src="{{ mix('js/blog/xterm.js')}}"></script>
@endsection
