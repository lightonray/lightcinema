<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Termwind\Components\Dd;

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
    public function addMoviePage()
    {
        $categories = Category::all();
        return view('addmovie', compact('categories'));
    }


    public function addMovie(Request $request)
    {

        dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
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
        $movie->image = $validatedData['image'];

        $movie->user_id = Auth::id();

        $movie->save();

        // attach categories 
        $movie->categories()->attach($validatedData['categories']);

        return redirect()->back()->with('success', 'Movie added successfully!');
    }


    public function movieDetailsPage($id)
    {
        $movie = Movie::findOrFail($id);

        return view('movie-details', compact('movie'));
    }


    public function submitRating(Request $request, $movieId)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        
        $rating = new Rating();
        $rating->movie_id = $movieId;
        $rating->user_id = auth()->id();
        $rating->rating = $validatedData['rating'];
        $rating->save();

        
        return response()->json(['message' => 'Rating submitted successfully'], 200);
    }

    public function submitComment(Request $request)
    {
        $rules = [
            'content' => 'required|string|max:255', 
        ];

        $messages = [
            'content.required' => 'Please enter your comment.',
            'content.max' => 'The comment may not be greater than :max characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        // Create a new comment instance with the validated data
        $comment = new Comment();
        $comment->user_id = auth()->user()->id; 
        $comment->movie_id = $request->movie_id;
        $comment->content = $request->input('content');
        $comment->save();

        // Fetch the user's name based on the user_id
        $user = User::find(auth()->user()->id);
        $userName = $user ? $user->name : 'Unknown User';

        // Include the user's name along with the comment details in the JSON response
        $response = [
            'success' => true,
            'message' => 'Comment posted successfully!',
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'user_id' => $comment->user_id,
                'user_name' => $userName, // Include the user's name
                'movie_id' => $comment->movie_id,
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at
            ]
        ];

        return response()->json($response);
    }

    public function comments()
    {
        $comments = Comment::with('user')->latest()->get();
        
        $response = $comments->map(function ($comment) {
            $userName = $comment->user ? $comment->user->name : 'Unknown User';
            return [
                'id' => $comment->id,
                'content' => $comment->content,
                'user_id' => $comment->user_id,
                'user_name' => $userName,
                'movie_id' => $comment->movie_id,
                'created_at' => $comment->created_at->toDateTimeString(),
                'updated_at' => $comment->updated_at->toDateTimeString() 
            ];
        });
        
        return response()->json($response);
    }
}
