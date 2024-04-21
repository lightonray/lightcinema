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
}
