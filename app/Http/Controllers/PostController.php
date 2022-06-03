<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|regex:/^[1-9][0-9]+/|not_in:0'
        ]);

        $post = new Post();
        $post->name = $request->name;
        $post->email = $request->email;
        $post->age = $request->age;
        $post->save();
        return redirect()->route('post.create')->with('message', '新規登録を完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $inputs = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|regex:/^[1-9][0-9]+/|not_in:0'
        ]);

        $post->name = $request->name;
        $post->email = $request->email;
        $post->age = $request->age;
        unset($post['_token']);
        $post->update();

        return redirect()->route('post.edit', compact('post'))->with('message', '内容を修正しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message', '登録内容をを削除しました');
    }
}
