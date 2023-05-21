<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('movies.index', ['movies'=>Movie::all(),'genres'=>Genre::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
//        $request->validate([
//            'title' => 'required',
//            'description' => 'required',
//            'image' => 'required',
//            'director' => 'required',
//            'actors' => 'required',
//            'duration' => 'required',
//            'score' => 'required|numeric|min:1|max:10',
//            'genres' => 'required|array',
//            'genres.*' => 'exists:genres,id',
//        ]);

        // Create a new movie
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->image = $request->input('image');
        $movie->director = $request->input('director');
        $movie->actors = $request->input('actors');
        $movie->duration = $request->input('duration');
        $movie->score = $request->input('score');
        $movie->save();

        // Attach genres to the movie
        $genres = $request->input('genres');
        foreach ($genres as $genre_id) {
            $genre = Genre::find($genre_id);
            $movie->genre()->attach($genre);
        }

        // Redirect to a page (e.g. the movie index page)
        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        // Update the movie details
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->image = $request->input('image');
        $movie->director = $request->input('director');
        $movie->actors = $request->input('actors');
        $movie->duration = $request->input('duration');
        $movie->score = $request->input('score');
        $movie->save();

        // Update genres of the movie
        // First, detach all existing genres
        $movie->genre()->detach();

        // Then, attach the new set of genres
        $genres = $request->input('genres');
        foreach ($genres as $genre_id) {
            $genre = Genre::find($genre_id);
            $movie->genre()->attach($genre);
        }

        // Redirect to a page (e.g. the movie index page)
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return  redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
