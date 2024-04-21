<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     */
    public function allMovies()
    {
        $movies = Movie::with('categories')->get();

        return view('admin.movies.index', compact('movies'));
    }
}
