<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * index
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //get all posts
        $posts = Post::latest()->get();

        //return view
        return inertia('posts/index', [
            'posts' => $posts
        ]);
    }
}
