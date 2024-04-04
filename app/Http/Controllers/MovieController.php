<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * Display the form for adding a new movie.
     *
     * @return \Illuminate\View\View
     */
    public function adMoviePage()
    {
        return view('addmovie');
    }


    public function addMovie(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Process the file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Create a new movie instance with the validated data
        $movie = new Movie();
        $movie->title = $validatedData['title'];
        $movie->description = $validatedData['description'];
        $movie->release_date = $validatedData['release_date'];
        $movie->duration = $validatedData['duration'];
        $movie->images = $validatedData['image'];

        $movie->user_id = Auth::id();

        $movie->save();

        return redirect()->back()->with('success', 'Movie added successfully!');
    }


    public function movieDetailsPage()
    {
        return view('movie-details');
    }
}
