
@extends('layouts.admin-dashboard')

@section("content")

    @if(! $errors->isEmpty())
        <div class="alert-box container mx-auto my-2">
            @foreach ($errors->all() as $message)
                <p class="alert alert-danger">{{$message}}</p>
            @endforeach
        </div>
    @endif


    <div class="w-50 mx-auto my-4">
        <form method="POST" action="{{route("admin.posts.store")}}" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <div class="mb-3">
                <label class="form-label">Post Title</label>
                <input type="text" name="Title" class="form-control"  >
            </div>
            <div class="mb-3">
                <label  class="form-label">Posts Content</label>
                <textarea  name="Content"  class="form-control"  rows="3"></textarea>
            </div>


            <div class="mb-3">
                <label  class="form-label">Category : </label>
                <select id="datalistOptions" name="category_id"  class="form-control" >
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"   >{{$category->cat_name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="d-flex flex-wrap">
                <h5 class="d-block w-100"> Tags :</h5>
                @foreach($tags as $tag)
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="{{ $tag->tag_name }}">
                        <label class="form-check-label" for="{{ $tag->tag_name }}"> {{ $tag->tag_name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Post Image : </label>
                <input class="form-control"  name="Post_image"  type="file" id="formFile">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
@endsection
