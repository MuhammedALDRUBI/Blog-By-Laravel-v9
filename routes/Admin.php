<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



Auth::routes(["register" => false]);

Route::middleware([  'auth' , 'verified'])->name("admin.")->group(function(){
    Route::get('/', "HomeController@index")->name("home");
    Route::resource('posts', "PostController");
}
);

