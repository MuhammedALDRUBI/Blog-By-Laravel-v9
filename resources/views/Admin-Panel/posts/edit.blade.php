@foreach ($errors->all() as $message)
    error : {{$message}} <br>
@endforeach

<form method="POST" action="{{route("admin.posts.update" , ["post" => $post])}}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="mb-3">
        <label class="form-label">Post Title</label>
        <input type="text" name="Title" value="{{ old("Title") != "" ? old('Title') : $post->Title }}" class="form-control"  >
    </div>
    <div class="mb-3">
        <label  class="form-label">Posts Content</label>
        <textarea  name="Content"  class="form-control"  rows="3">{{  old("Content") != "" ? old('Content') : $post->Content }}</textarea>
    </div>

    <div class="mb-3">
        <label  class="form-label">Category : </label>
        <select id="datalistOptions" name="category_id"  class="form-control" >
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if($category->id == $post->category->id) selected @endif >{{$category->cat_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-check">
        Tags :
        @foreach($tags as $tag)

            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="{{ $tag->tag_name }}"
                   @foreach($post->tags as $post_tag)
                   @if($post_tag->id  == $tag->id) checked @endif
                @endforeach
            >
            <label class="form-check-label" for="{{ $tag->tag_name }}"> {{ $tag->tag_name }}</label>

        @endforeach
        old tags {{   old("tags") }}

    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Post Image : </label>
        <input class="form-control"  name="Post_image"  type="file" id="formFile">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
