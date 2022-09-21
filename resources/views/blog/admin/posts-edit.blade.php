@extends('blog.admin.layouts.master')
@section('title','Post Edit')
@section('content')
    @include('blog.admin.partials.page-header', [
    'svg' => 'Edit Post',
    'title' => 'Edit Post',
    'description' => 'Edit an existing blog post.',
    'button'=> $post->isPublished() ? 'View Post': 'Preview Post',
    ])
    @include('blog.admin.partials.flash-with-link')
    <form action="{{ route('blog.admin.posts.update', $post) }}" method="post"
          class="flex flex-wrap mb-4">
        @csrf
        @method('PATCH')
        @include('blog.admin.partials.post.post-form', ['submitText' => 'Update'])
    </form>
@endsection
