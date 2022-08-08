@extends('Admin-Panel.layouts.app')

@section("content")

@foreach ($posts as $post)
Author : {{ $post->user->name }}  <br>
Post Poster :
<img style="max-width:200px ;" src="{{asset("storage/" . $post->image->folder_path . "/" . $post->image->image_name)}}" >

<br>
Category : {{ $post->category->cat_name  }} <br>
tags : @foreach ($post->tags as $tag)
 {{ $tag->tag_name  }} ,
@endforeach
<a href="{{route("admin.posts.show" , ["post" => $post])}}">Show Post Details</a>
<hr>
@endforeach
<a href="{{ route("admin.posts.create") }}">Create a new post</a>

@endsection
