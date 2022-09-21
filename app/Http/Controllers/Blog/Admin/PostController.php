<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\PostRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PostController extends Controller
{
    public function __construct()
    {
        view()->share('categories', BlogCategory::all());
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View|Application
    {
        $data['posts'] = BlogPost::orderBy('created_at', 'DESC')->get();

        return view('blog.admin.posts', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $post = new BlogPost();
        $post->published_at = now();
        $post->status = 'Draft';

        return view('blog.admin.posts-create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $post = BlogPost::create($request->validated());
        $post->syncSaveTags($request);
        flash('Post created.');

        return redirect()->route('blog.admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(BlogPost $post)
    {
        return view('blog.admin.posts-edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     *
     * @throws \JsonException
     */
    public function update(PostRequest $request, BlogPost $post)
    {
        $post->updateAttributes($request);
        flash('Post updated.');

        return redirect()->route('blog.admin.posts.edit', $post);
    }

    /**
     * Generates a markdown preview for the post.
     *
     * @return array
     */
    public function preview(BlogPost $post)
    {
        $post->content = request('payload', '');

        return ['data' => ['html' => $post->content]];
    }

    /**
     * Upload an image.
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upload(BlogPost $post, ImageUploadRequest $request)
    {
        try {
            $media = $post->addMedia($request->file('image'))
                ->toMediaCollection('blog_images');
        } catch (FileDoesNotExist | FileIsTooBig $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

        return [
            'data' => [
                'filePath' => ltrim($media->getUrl()),
            ],
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  BlogPost  $post
     * @return RedirectResponse
     */
    public function destroy(BlogPost $post): RedirectResponse
    {
        $post->delete();
        flash('Post deleted.');

        return redirect()->route('blog.admin.posts.index');
    }
}
