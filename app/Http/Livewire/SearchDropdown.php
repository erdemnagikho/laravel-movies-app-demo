<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];
        if (strlen($this->search) >= 2) {
            $searchResults = Http::get('https://api.themoviedb.org/3/search/movie?query=' . $this->search . '&api_key=' . config('services.tmdb.token'))->json()['results'];
        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(9)
        ]);
    }
}
