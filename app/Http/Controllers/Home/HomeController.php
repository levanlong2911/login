<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $comments = Comment::all();
        $posts = Post::all();
        view()->share('posts', $posts);
        view()->share('comment', $comments);
    }
    public function index()
    {
        return view('dashboard.home.home');
    }
    public function detail($slug, $id, Request $request)
    {
        $posts = Post::find($id);
        $comments = Comment::where('post_id', $id)->get();
        return view('dashboard.home.detail', compact('posts', 'comments'));
    }
    
}
