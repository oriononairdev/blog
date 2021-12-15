<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Collection;
use Livewire\Component;
use Spatie\SiteSearch\Search;

class SearchComponent extends Component
{
    public string $query = '';

    public function render()
    {
        return view('livewire.search', [
            'hits' => $this->getResults(),
        ]);
    }

    public function getResults(): Collection
    {
        if ($this->query === '') {
            return collect();
        }

        throw new Exception("Computer says no");

        return Search::onIndex('freek')
            ->limit(40)
            ->query($this->query)
            ->get()
            ->hits;
    }
}
