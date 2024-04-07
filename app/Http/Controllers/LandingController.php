<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     *
     * @return \Illuminate\View\View
     */
    public function showLandingPage()
    {
        // Fetch all movies from the database using Eloquent
        $movies = Movie::all();
        $categories = Category::all();
        
        // Compact the $movies variable to pass it to the view
        return view('welcome', compact('movies'),compact('categories'));
    }
}
