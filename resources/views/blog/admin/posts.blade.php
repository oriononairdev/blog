@extends('blog.admin.layouts.master')
@section('title','Posts')
@section('content')
    @include('blog.admin.partials.page-header', ['title' => 'Posts', 'description' => 'Blog posts sorted by publish date.','button'=> 'New Post'])
    @include('blog.admin.partials.flash')
    @include('blog.admin.partials.post.post-list')
@endsection
