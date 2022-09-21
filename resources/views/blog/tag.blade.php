@extends('blog.layouts.master')
@section('title'){{$tag}}@endsection
@section('content')
    @include('blog.partials.postlist')
@endsection
