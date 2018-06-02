<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stats = [
            'posts' => Post::all()->count(),
            'cats' => Category::all()->count(),
            'tags' => Tag::all()->count(),
            'users' => User::all()->count(),
        ];
        return view('home',['stats' => $stats]);
    }
}
