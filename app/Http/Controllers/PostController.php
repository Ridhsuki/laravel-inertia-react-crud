<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:posts index', only: ['index']),
            new Middleware('permission:posts create', only: ['store']),
            new Middleware('permission:posts edit', only: ['update']),
            new Middleware('permission:posts delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // get all posts
        $posts = Post::with('user')
            ->whereUserId($request->user()->id)
            ->when($request->search, fn($query) => $query->where('title', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(10)->withQueryString();

        // render view
        return inertia('Posts/Index', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:255',
        ]);

        // create new post
        Post::create([
            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // render view
        return to_route('posts.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // validate request
        $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:255',
        ]);

        // update post
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // render view
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // delete post
        $post->delete();

        // render view
        return back();
    }
}
