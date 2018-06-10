<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }

    /**
     * Show posts.
     */
    public function index(): \Illuminate\Http\Response
    {
        return view('posts', ['posts' => Post::all()]);
    }

    /**
     * Show a specific post
     */
    public function show(Post $post): \Illuminate\Http\Response
    {
        return view('post')->with(
            [
                'post' => $post
            ]
        );
    }

    /**
     * Persist post to database
     */
    public function create(Request $request): \Illuminate\Http\Response
    {

        $post = Auth::user()->posts()->create(
            $request->validate([
                'title' => 'required|string',
                'body'  => 'required|string',
            ])
        );

        return redirect()->route('post', $post);
    }
}
