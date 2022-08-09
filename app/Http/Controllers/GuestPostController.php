<?php

namespace App\Http\Controllers;

use App\Models\AdminMoldels\Post;
use Illuminate\Http\Request;

class GuestPostController extends Controller
{
    public function index()
    {
        $posts = Post::with(["user" ,"image" , "category" , "tags"])->paginate(10) ;
        return view('website-posts.index' , ["posts" => $posts]);
    }


    public function show(Post $post)
    {
        $variables_array = ["post" => $post  ];
        return view("website-posts.show" , $variables_array);
    }

}
