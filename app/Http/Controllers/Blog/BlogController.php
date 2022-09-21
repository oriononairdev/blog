<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPage;
use App\Models\BlogPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(): Factory|View|Application
    {
        $data['posts'] = BlogPost::orderBy('is_pinned', 'DESC')
            ->orderBy('published_at', 'DESC')
            ->published()
            ->localized()
            ->simplePaginate(23);

        return view('blog.home', $data);
    }

    public function single(Request $request, $id, $slug)
    {
        $post = BlogPost::where([
            ['id', $id],
        ])
                ->first() ?? abort(404);
        $post->increment('view_count');
        if ($request->input('preview') === $post->preview_secret || $post->isPublished()) {
            $data['post'] = $post;

            return view('blog.single', $data);
        }
        abort(403);
    }

    public function category($slug): Factory|View|Application
    {
        $data['category'] = BlogCategory::where('slug', $slug)
                ->first() ?? abort(404);
        $data['posts'] = BlogPost::where([['category_id', $data['category']->id]])
            ->published()
            ->localized()
            ->orderBy('is_pinned', 'DESC')
            ->orderBy('published_at', 'DESC')
            ->simplePaginate(15) ?? abort('404');

        return view('blog.category', $data);
    }

    public function tag($slug): Factory|View|Application
    {
        if (str_contains($slug, '#')) {
            route('tag', str_replace('#', '%23', $slug));
        }
        $data['posts'] = BlogPost::withAllTags([$slug])
            ->orderBy('is_pinned', 'DESC')
            ->orderBy('published_at', 'DESC')
            ->published()
            ->localized()
            ->simplePaginate(15);
        if (! $data['posts'][0]) {
            abort(404);
        }
        $data['tag'] = $slug;

        return view('blog.tag', $data);
    }

    public function page($slug): Factory|View|Application
    {
        $data['page'] = BlogPage::where([['slug', $slug], ['status', 1]])->first() ?? abort(404);
        if ($slug === 'originals') {
            $data['posts'] = BlogPost::where([['type', 'Original']])
                ->published()
                ->localized()
                ->orderBy('is_pinned', 'DESC')
                ->orderBy('published_at', 'DESC')
                ->simplePaginate(25);
        }

        return view('blog.page', $data);
    }
}
