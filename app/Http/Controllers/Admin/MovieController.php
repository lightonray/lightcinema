<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guest');
    }
    
    /**
     * Display a list of all movies along with their categories.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function allMovies()
    {
        $movies = Movie::with('categories')->get();

        return view('admin.movies.index', compact('movies'));
    }


    /**
     * Display the form for editing a specific movie.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editMovie($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }


    /**
     * Update the specified movie in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMovie(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // Add validation rules for other fields as needed
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($validatedData);

        return redirect()->route('admin.movies.index')->with('success', 'Movie details updated successfully');
    }
}
