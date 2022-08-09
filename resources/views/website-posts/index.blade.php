@extends('layouts.website-layout')

@section("content")

    <div class="container">
        <div class="row">
        @foreach ($posts as $post)
            <div class="post-box col-md-3 col-sm-4 col-10 mx-auto my-2 text-center" style="height:400px">
                <div class="img-box w-75 mx-auto my-1" style="height:70%">
                    <img style="max-width:100%; max-height: 100%" src="{{asset("storage/" . $post->image->folder_path . "/" . $post->image->image_name)}}" >
                </div>
                <h3>{{$post->Title}}</h3>
                <small>Author : {{ $post->user->name }}  / Category : {{ $post->category->cat_name  }} </small>
                <p> <span>Post Tags : </span>
                    @foreach ($post->tags as $tag)
                        #{{ $tag->tag_name  }} ,
                    @endforeach
                </p>
                <a class="btn btn-info" href="{{route("website.post.show" , ["post" => $post])}}">More Details</a>
            </div>
        @endforeach
            {{$posts->links()}}
        </div>
    </div>

@endsection
