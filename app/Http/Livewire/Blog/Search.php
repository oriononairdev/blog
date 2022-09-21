<?php

namespace App\Http\Livewire\Blog;

use App\Models\BlogPost;
use Illuminate\Support\Collection;
use Livewire\Component;

class Search extends Component
{
    public string $query = '';

    public function render()
    {
        return view('livewire.blog.search', [
            'results' => $this->getResults(),
        ]);
    }

    public function getResults(): Collection
    {
        if ($this->query === '') {
            return collect();
        }

        //return Post::search($this->query)->take(30)->get();
        return BlogPost::orderBy('published_at', 'DESC')
            ->published()
            ->take(30)
            ->get();
    }
}
