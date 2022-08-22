<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\tagResource;
use App\Models\AdminMoldels\Tag;
use App\Models\AdminMoldels\Category;
use App\Models\AdminMoldels\Post;
use App\Models\User;
use Database\Factories\PostFactory;
use Database\Factories\UserFactory;
use Database\Factories\CategoryFactory;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    echo "This is our Blog main page .... ";
    echo "<a href='" . route("website.posts") . "' >Show Posts</a>";
})->name("main");
Route::get('posts', "GuestPostController@index")->name("posts");
Route::get('post/show/{post}', "GuestPostController@show")->name("post.show");

Route::get('post/test', "GuestPostController@test");
