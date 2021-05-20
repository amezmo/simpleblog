<?php

use App\Http\Controllers\ControllerExample;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {

    Route::get('posts', [ControllerExample::class, 'post']); // list all posts
    Route::get('posts/{id}', [ControllerExample::class, 'singlePost']); // get a post
    Route::post('posts', [ControllerExample::class, 'createPost']); // add a new post
    Route::put('posts/{id}', [ControllerExample::class, 'updatePost']); // updating a post
    Route::delete('posts/{id}', [ControllerExample::class, 'deletePost']); // delete a post

    Route::post('users/writer', [ControllerExample::class, 'createWriter']); // add a new user with writer scope
    Route::post('users/subscriber', [ControllerExample::class, 'createSubscriber']); // add a new user with subscriber scope
    Route::delete('users/{id}', [ControllerExample::class, 'deleteUser']); // delete a user

});
