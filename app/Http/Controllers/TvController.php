<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    public function index()
    {
        $popularTv = Http::get('https://api.themoviedb.org/3/tv/popular?api_key=' . config('services.tmdb.token'))->json()['results'];
        $topRatedTv = Http::get('https://api.themoviedb.org/3/tv/top_rated?api_key=' . config('services.tmdb.token'))->json()['results'];
        $genres = Http::get('https://api.themoviedb.org/3/genre/tv/list?api_key=' . config('services.tmdb.token'))->json()['genres'];

        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tv.index', $viewModel);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $tvshow = Http::get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images&api_key=' . config('services.tmdb.token'))->json();
        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show', $viewModel);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
