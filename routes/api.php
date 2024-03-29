<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('posts', 'PagesController@home');
Route::get('blog/{post}', 'PostsController@show');
Route::get('categories/{category}', 'CategoriesController@show');
Route::get('tags/{tag}', 'TagsController@show');
Route::get('archive', 'PagesController@archive');

Route::post('message', function () {
    return response()->json([
        'status' => 'OK',
    ]);
});
