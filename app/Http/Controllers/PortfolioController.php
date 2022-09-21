<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class PortfolioController extends Controller
{
    public function index()
    {
        $data['portfolio'] = Portfolio::orderBy('is_pinned', 'DESC')
            ->published()
            ->orderBy('published_at', 'DESC')
            ->simplePaginate(23);

        return view('blog.pages.portfolio.index', $data);
    }

    public function show(Request $request, $id, $slug)
    {
        $project = Portfolio::where([
            ['id', $id],
        ])->first() ?? abort(404);
        if ($project->is_published || $request->input('preview') === $project->preview_secret) {
            $data['project'] = $project;

            return view('blog.pages.portfolio.show', $data);
        }
        abort(403);
    }

    public function tag($tag)
    {
        $tag = Tag::where('slug->en', $tag)->first();
        $data['tag'] = $tag->name;
        $data['portfolio'] = Portfolio::withAllEnTags([$tag->name])
                ->published()->orderBy('is_pinned', 'DESC')->orderBy('published_at', 'DESC')
                ->simplePaginate(15) ?? abort(404);

        return view('blog.pages.portfolio.index', $data);
    }
}
