<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guest');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $movieCount = Movie::count();

        return view('admin.home', compact('userCount', 'movieCount'));
    }
}
