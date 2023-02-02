<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $posts = App\Post::latest('published_at')->get();
    return view('welcome', compact('posts'));
})->name('welcome');

Route::get('posts', function () {
    return App\Post::all();
})->name('posts');

Route::get('admin', function () {
    return view('admin.layout');
})->name('admin');
Auth::routes();

#Route::get('/home', 'HomeController@index')->name('home');
Route::auth();