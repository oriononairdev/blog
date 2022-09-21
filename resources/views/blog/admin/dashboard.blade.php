@extends('blog.admin.layouts.master')
@section('title','Dashboard')
@section('content')
    @include('blog.admin.partials.page-header', ['svg' => 'Post List', 'title' => 'Latest Posts', 'description' => 'Latest blog posts sorted by publish date.','button'=>'New Post'])
    @include('blog.admin.partials.flash')
    @include('blog.admin.partials.post.post-list')
@endsection
