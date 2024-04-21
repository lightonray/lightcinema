<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use App\Models\Category;
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
        $allCategories = Category::all(); // Fetch all categories
        $selectedCategories = $movie->categories; // Fetch specific categories of the movie
        return view('admin.movies.edit', compact('movie', 'allCategories', 'selectedCategories'));
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'director' => 'required|string|max:255',
            'categories' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Fetch the movie record to update
        $movie = Movie::findOrFail($id);

        // Update the movie details with the validated data
        $movie->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'release_date' => $validatedData['release_date'],
            'duration' => $validatedData['duration'],
            'director' => $validatedData['director'],
        ]);

        // Update movie categories
        $movie->categories()->sync($validatedData['categories']);

        // Process the file upload if an image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $movie->image = $imageName;
            $movie->save();
        }

        return redirect()->route('admin.movies.index')->with('success', 'Movie details updated successfully');
    }

    /**
     * Remove the specified movie from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        return redirect()->back()->with('success', 'Movie deleted successfully!');
    }
}
