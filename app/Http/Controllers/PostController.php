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

    /**
     * create
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return inertia('posts/create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        //set validation
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        //create post
        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        //redirect
        return redirect()->route('posts.index')->with('message', 'Data Berhasil Disimpan!');
    }

    /**
     * edit
     *
     * @param  mixed $post
     * @return \Inertia\Response
     */
    public function edit(Post $post)
    {
        return inertia('posts/edit', [
            'post' => $post,
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        //set validation
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        //update post
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        //redirect
        return redirect()->route('posts.index')->with('message', 'Data Berhasil Diupdate!');
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        //delete post
        $post->delete();

        //redirect
        return redirect()->route('posts.index')->with('message', 'Data Berhasil Dihapus!');
    }
}
