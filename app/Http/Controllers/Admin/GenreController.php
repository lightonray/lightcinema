<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guest');
    }


     /**
     * Display the view for the Genres.
     *
     * @return \Illuminate\View\View
     */
    public function allGenres()
    {
        $genres = Category::all();
        
        return view('admin.genre.index', compact('genres'));
    }

    /**
     * Show the form for editing the specified genre.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $genre = Category::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
    }

    /**
     * Update the specified genre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other fields as needed
        ]);

        $genre = Category::findOrFail($id);
        $genre->update($validatedData);

        return redirect()->route('admin.genres.index')->with('success', 'Genre details updated successfully');
    }

    /**
     * Remove the specified genre from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $genre = Category::findOrFail($id);

        $genre->delete();

        return redirect()->back()->with('success', 'Genre deleted successfully!');
    }
}
