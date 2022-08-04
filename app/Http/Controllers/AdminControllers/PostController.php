<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminMoldels\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::with(["user" ,"image" , "category" , "tags"])->paginate(10) ;
        return view("" , ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           "Title" => "bail|required|String",
           "Content" => "bail|required|String" ,
           "category_id" => "bail|required|Numeric" ,
           "user_id" => "bail|required|Numeric"
        ]);

        Post::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("" , ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("" , ["post" => $post]);
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
        $request->validate([
           "Title" => "bail|required|String",
           "Content" => "bail|required|String" ,
           "category_id" => "bail|required|Numeric" ,
           "user_id" => "bail|required|Numeric"
        ]);
        $post = Post::findOrFail($request->input(id));
        $post->update($request->all());
        return redirect()->back()->with("message" , "Post has been updated !");
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
        return redirect()->back()->with("message" , "Post has been deleted !");
    }
}
