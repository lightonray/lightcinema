<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
     /**
     * Display the form for adding a new movie.
     *
     * @return \Illuminate\View\View
     */
    public function adMoviePage()
    {
        return view('addmovie');
    }
}
