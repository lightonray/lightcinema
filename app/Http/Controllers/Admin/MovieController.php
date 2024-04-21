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
}
