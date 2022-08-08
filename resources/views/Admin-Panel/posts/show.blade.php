@extends('Admin-Panel.layouts.app')

@section("content")

Author : {{ $post->user->name }}  <br>

Post Poster :
<img style="max-width:200px ;" src="{{asset("storage/" . $post->image->folder_path . "/" . $post->image->image_name)}}" >

<br>
Category : {{ $post->category->cat_name  }} <br>
tags : @foreach ($post->tags as $tag)
    {{ $tag->tag_name  }} ,
@endforeach
<a href="{{route("admin.posts.edit" , ["post" => $post])}}">edit Post</a>

<form action="{{ route("admin.posts.destroy" , ["post" => $post]) }}" method="POST">
    @csrf
    @method("DELETE")
    <input type="submit" value="Delete">
</form>
<hr>
@endsection
