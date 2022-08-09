<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminMoldels\Category;
use App\Models\AdminMoldels\Image;
use App\Models\AdminMoldels\Post;
use App\Models\AdminMoldels\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder;

class PostController extends Controller
{

    public function index()
    {

        $posts = Post::with(["user" ,"image" , "category" , "tags"])->paginate(10) ;
        return view("Admin-Panel.posts.index" , ["posts" => $posts]);
    }


    public function create()
    {
        $categories = Category::cursor();
        $tags = Tag::cursor();
        return view("Admin-Panel.posts.create" , ["categories" => $categories , "tags" => $tags]);
    }


    public function store(Request $request)
    {
        $request->validate([
           "Title" => "bail|required|String",
           "Content" => "bail|required|String" ,
           "category_id" => "bail|nullable|integer",
           "tags" => "bail|required|array",
           "Post_image" => "bail|required|image"
        ]);

        $post = Post::create([
            "Title" => $request->input('Title') ,
            "Content" => $request->input('Content') ,
            "user_id" => Auth::user()->id,
            "category_id" => $request->input('category_id') ,
        ]);

        $tagsFromRequest =  $request->input('tags') ;
        $found_tags_count = Tag::whereIn("id" , $tagsFromRequest)->count();
        $image_object = $request->file("Post_image");
        $image_extenssion = $image_object->getClientOriginalExtension();
        $image_new_name = $post->id . "." .  $image_extenssion;

        if($post != null && $found_tags_count === count($request->input("tags"))){
            if($found_tags_count != 0){
                $post->tags()->sync($request->input('tags'));
            }
            $post_image_object = new Image(["folder_path" =>  "post_images" , "image_name" => $image_new_name]);
            $post->image()->save($post_image_object);
            $image_object->storeAs("post_images" , $image_new_name , "public");

            return redirect()->route("admin.posts.index");
        }
        return redirect()->back()->withErrors(["error" => "there is a wrong !"]);
    }


    public function show(Post $post)
    {
        $variables_array = ["post" => $post  ];
        return view("Admin-Panel.posts.show" , $variables_array);
    }


    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::cursor();
        $tags = Tag::cursor();
        $variables_array = ["post" => $post  , "categories" => $categories , "tags" => $tags  ];
        return view("Admin-Panel.posts.edit" , $variables_array);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $request->validate([
            "Title" => "bail|required|String",
            "Content" => "bail|required|String" ,
            "category_id" => "bail|nullable|integer",
            "tags" => "bail|required|array",
            "Post_image" => "nullable|image"
        ]);

        $tagsFromRequest =   $request->input('tags');
        $found_tags_count = Tag::whereIn("id" , $tagsFromRequest)->count();

        $image_object = $request->file("Post_image");

        if( $found_tags_count === count($request->input("tags"))){
            $post->update($request->all());
            $post->tags()->sync($request->input('tags'));

            if($image_object !== null){
                $image_extenssion = $image_object->getClientOriginalExtension();
                $image_new_name = $post->id . "." .  $image_extenssion;

                $post_image_object = $post->image;
                $post_image_object->folder_path =  "post_images" ;
                $post_image_object->image_name = $image_new_name;
                $post_image_object->save();

                $image_object = $request->file("Post_image");
                $image_object->storeAs("post_images" , $image_new_name , "public");
            }

            return redirect()->route("admin.posts.show" , ["post" => $post ])->with(["message" => "Post has been updated !" ]);
        }
        return redirect()->back()->withErrors(["error" => "there is a wrong !"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route("admin.posts.index")->with("message" , "Post has been deleted !");
    }
}
