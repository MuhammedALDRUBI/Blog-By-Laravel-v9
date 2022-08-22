@extends("layouts.website-layout")

@section("head-part")

    <style>
        h2{
            box-shadow: 0 0 0 #333;
        }
        p{
            box-shadow: 0 0 0 #999;
        }
    </style>
    <script>window.print()</script>
@endsection

@section("content")

    <div class="testContainer container">
        <h2 class="bg-dark text-white">This is a heading</h2>
        <p class="bg-secondary text-success">This is a paragraph</p>
    </div>


@endsection
<iframe src="{{ route("website.posts") }}" class="w-100 h-100"></iframe>
