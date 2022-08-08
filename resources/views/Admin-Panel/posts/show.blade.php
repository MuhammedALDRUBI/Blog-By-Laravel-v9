@extends('Admin-Panel.layouts.app')

@section("content")

    <div class="container">
        <div class="post-box d-flex col-10 mx-auto my-2 text-center" style="height:400px">
            <div class="img-tags-box col-6">
                <div class="img-box w-75 mx-auto my-1" style="height:70%">
                    <img style="max-width:100%; max-height: 100%" src="{{asset("storage/" . $post->image->folder_path . "/" . $post->image->image_name)}}" >
                </div>
                <small>Author : {{ $post->user->name }}  / Category : {{ $post->category->cat_name  }} </small>
                    @if(! $post->tags->isEmpty())
                    <p> <span>Post Tags : </span>
                        @foreach ($post->tags as $tag)
                            #{{ $tag->tag_name  }} ,
                        @endforeach
                    @endif

                </p>
                <a class="btn btn-success" href="{{route("admin.posts.edit" , ["post" => $post])}}">Edit</a>

                <form class="d-inline-block" action="{{ route("admin.posts.destroy" , ["post" => $post]) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input class="btn btn-danger" type="submit" value="Delete">
                </form>
            </div>

            <div class="post-info col-6">
                <h4>{{ $post->Title }}</h4>
                <div class="content text-start">{{$post->Content}}</div>
            </div>
        </div>
    </div>
@endsection
