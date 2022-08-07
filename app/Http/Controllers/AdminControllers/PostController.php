<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminMoldels\Category;
use App\Models\AdminMoldels\Image;
use App\Models\AdminMoldels\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder;

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

        foreach ($posts as $post){
            echo $post->user->name . "<br>";
            echo $post->image->folder_path . $post->image->image_name . "<br>";
            echo $post->category->cat_name . "<br>";
            foreach ($post->tags as $tag) {
                echo $tag->tag_name . "<br>";
            }
            echo "<hr>";
        }
////        return view("" , ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  "create page";
//        return view();
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
           "category_id" => "bail|required|Numeric"
        ]);

        $post = Post::create([
            "Title" => $request->input('Title') ,
            "Content" => $request->input('Content') ,
            "user_id" => Auth::user()->id
        ]);
        $category = Category::find($request->input('category_id'));
        if($post != null && $category != null){
            $post_image = new Image(["folder_path" =>  "/" , "image_name" => "test.jpg"]);
            $post->image()->save($post_image);
            $post->category()->associate($category);
            $post->tags()->sync($request->input('tags'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
//        $path1 = Storage::disk("local")->path("1.jpg");
//        $path2 = Storage::disk("public")->url("1.jpg");
//        echo  $path1 . "<br>";
//        echo  $path2 . "<br>";
//        echo "<img src=" . asset($path2) . ">";

        $image = Storage::disk("public")->get("1.jpg");
        echo Storage::disk("public")->put("new/test.jpg" , $image );
//        if($post){
//            return $post;
//        }
//        return redirect()->back();
//        return view("" , ["post" => $post]);
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
