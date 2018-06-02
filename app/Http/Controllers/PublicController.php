<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 01/06/18
 * Time: 15:12
 */

namespace App\Http\Controllers;


use App\Post;

class PublicController extends Controller
{
    public function home() {
        $posts = Post::all();
        return view('welcome')->with('posts', $posts);
    }
}