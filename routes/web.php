<?php

use Illuminate\Support\Facades\Auth;
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
// Route::get('email', function(){
//     return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
// });
Route::get('/', 'PagesController@home')->name('home');
Route::get('nosotros', 'PagesController@about')->name('about');
Route::get('archivo', 'PagesController@archive')->name('archive');
Route::get('contacto', 'PagesController@contact')->name('contact');

Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
// Route::get('user/{user}', 'UserController@show')->name('users.show');
Route::get('categorias/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('etiquetas/{tag}', 'TagsController@show')->name('tags.show');

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
        Route::get('/', 'AdminController@index')->name('admin');
        Route::resource('posts', 'PostsController', ['except' => 'show', 'as' => 'admin']);
        Route::resource('users', 'UsersController', ['as' => 'admin']);
        Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
        Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy'], 'as' => 'admin']);

        Route::middleware('role:Admin')
            ->put('users/{user}/roles', 'UsersRolesController@update')
            ->name('admin.users.roles.update');
        Route::middleware('role:Admin')
            ->put('users/{user}/permissions', 'UsersPermissionsController@update')
            ->name('admin.users.permissions.update');
        // Route::get('posts', 'PostsController@index')->name('admin.posts.index');
        // Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
        // Route::post('posts/store', 'PostsController@store')->name('admin.posts.store');
        // Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
        // Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
        // Route::delete('posts/{post}', 'PostsController@destroy')->name('admin.posts.destroy');

        Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
        Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
    }
);



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::auth();