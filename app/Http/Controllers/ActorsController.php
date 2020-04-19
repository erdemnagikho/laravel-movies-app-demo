<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    public function index($page = 1)
    {
        abort_if($page > 500, 204);
        $popularActors = Http::get('https://api.themoviedb.org/3/person/popular?api_key=' . config('services.tmdb.token') . '&page=' . $page)->json()['results'];
        $actorsViewModel = new ActorsViewModel($popularActors, $page);
        return view('actors.index', $actorsViewModel);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $actor = Http::get('https://api.themoviedb.org/3/person/' . $id . '?api_key=' . config('services.tmdb.token'))->json();
        $social = Http::get('https://api.themoviedb.org/3/person/' . $id . '/external_ids?api_key=' . config('services.tmdb.token'))->json();
        $credits = Http::get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits?api_key=' . config('services.tmdb.token'))->json();
        $actorViewModel = new ActorViewModel($actor, $social, $credits);
        return view('actors.show', $actorViewModel);
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
