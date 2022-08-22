<?php

namespace App\Http\Controllers;

use App\Models\AdminMoldels\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

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
    public function test( )
    {
        Session::put("testKey" , "1");
        Cookie::queue('name', "Muhammed" , 10);

    }

}
