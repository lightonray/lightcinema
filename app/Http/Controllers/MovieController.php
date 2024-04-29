<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Category;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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


    /**
     * Add a new movie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addMovie(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'release_date' => 'required|date',
                'duration' => 'required|integer|min:1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'categories' => 'required|array',
                'director' => 'required|string|max:255',
                'actors' => 'required|array',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $validatedData['image'] = $imageName;
            }

            $movie = new Movie($validatedData);
            $movie->user_id = Auth::id(); // Assuming the user's ID is to be stored
            $movie->save();

            // Attach categories and actors
            $movie->categories()->attach($validatedData['categories']);
            foreach ($validatedData['actors'] as $actorName) {
                if ($actorName !== null) {
                    $actor = Actor::firstOrCreate(['name' => $actorName]);
                    $movie->actors()->attach($actor->id);
                }
            }

            return redirect()->back()->with('success', 'Movie added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add movie: ' . $e->getMessage());
        }
    }


    /**
     * Submit a rating for a specific movie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $movieId
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Submit a comment for a movie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        $comment = new Comment();
        $comment->user_id = auth()->user()->id; 
        $comment->movie_id = $request->movie_id;
        $comment->content = $request->input('content');
        $comment->save();


        $user = User::find(auth()->user()->id);
        $userName = $user ? $user->name : 'Unknown User';

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

    /**
     * Retrieve all comments along with their associated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
