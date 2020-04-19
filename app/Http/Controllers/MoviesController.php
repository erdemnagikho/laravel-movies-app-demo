<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    public function index()
    {
        $popularMovies = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=' . config('services.tmdb.token'))->json()['results'];
        $nowPlayingMovies = Http::get('https://api.themoviedb.org/3/movie/now_playing?api_key=' . config('services.tmdb.token'))->json()['results'];
        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=' . config('services.tmdb.token'))->json()['genres'];

//        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
//            return [$genre['id'] => $genre['name']];
//        });

//        return view('index', [
//            'popularMovies' => $popularMovies,
//            'nowPlayingMovies' => $nowPlayingMovies,
//            'genres' => $genres
//        ]);

        $moviesViewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $genres);
        return view('movies.index', $moviesViewModel);
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
        $movie = Http::get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images&api_key=' . config('services.tmdb.token'))->json();

        $movieViewModel = new MovieViewModel($movie);

        return view('movies.show', $movieViewModel);

//        return view('show', [
//            'movie' => $movie
//        ]);
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
