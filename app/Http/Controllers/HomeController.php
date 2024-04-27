<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     *
     * @return \Illuminate\View\View
     */
    public function showLandingPage()
    {
        $movies = Movie::all();
        $categories = Category::all();
        
        return view('index', compact('movies'),compact('categories'));
    }

    /**
     * Display the details page for a specific movie.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function movieDetailsPage($id)
    {
        $movie = Movie::findOrFail($id);

        return view('movie-details', compact('movie'));
    }
}
