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

Route::get('/', 'PagesController@home')->name('welcome');
Route::get('blog/{post}', 'PostsController@show')->name('show');

Auth::routes(['register' => false]);

Route::get('posts', function () {
    return App\Post::all();
})->name('posts');

/*Route::get('admin', function () {
    return view('admin.layout');
})->middleware('auth')->name('admin');*/



Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('posts', 'PostsController@index')->name('admin.posts.index');
        Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
        Route::get('/', 'AdminController@index')->name('admin');
        Route::post('posts/store', 'PostsController@store')->name('admin.posts.store');
        Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
        Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
});



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::auth();
