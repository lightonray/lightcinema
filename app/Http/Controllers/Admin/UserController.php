<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     *
     * @return \Illuminate\View\View
     */
    public function allUsers()
    {
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
    }
}
