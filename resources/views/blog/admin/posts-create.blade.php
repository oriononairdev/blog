@extends('blog.admin.layouts.master')
@section('title','Post Create')
@section('content')
    @include('blog.admin.partials.page-header', ['svg' => 'New Post', 'title' => 'New Post', 'description' => 'Create a new blog post.'])
    @include('blog.admin.partials.flash')
    <form action="{{ route('blog.admin.posts.store',$post) }}" method="post"
          class="flex flex-wrap mb-4">
        @csrf
        @include('blog.admin.partials.post.post-form', ['submitText' => 'Create'])
    </form>
@endsection
@section('page-level-js')
    <script src="{{ mix('js/blog/admin/text-editor.js')}}"></script>
@endsection
