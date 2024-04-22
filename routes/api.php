<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::post('/register','AuthController@register');
    Route::post('/login','AuthController@login');
    Route::post('/logout','AuthController@logout')->middleware('auth:sanctum');

});

Route::middleware(['CheckPassword','Check-Auth'])
->namespace('App\Http\Controllers\Api')
->prefix('posts')
->group(function () {

  Route::get('/','PostController@index');
  Route::post('/store','PostController@store');
  Route::get('/show/{id}','PostController@show');
  Route::patch('/update/{id}','PostController@update');
  Route::delete('/delete/{id}','PostController@destroy');

});


Route::middleware(['CheckPassword','Check-Auth'])
->namespace('App\Http\Controllers\Api')
->prefix('likes')
->group(function () {

  Route::get('/','LikeController@index');
  Route::post('/store','LikeController@store');
  Route::get('/show/{id}','LikeController@show');
  Route::patch('/update/{id}','LikeController@update');
  Route::delete('/delete/{id}','LikeController@destroy');

});



Route::middleware(['CheckPassword','Check-Auth'])
->namespace('App\Http\Controllers\Api')
->prefix('comments')
->group(function () {

  Route::get('/','CommentController@index');
  Route::post('/store','CommentController@store');
  Route::get('/show/{id}','CommentController@show');
  Route::patch('/update/{id}','CommentController@update');
  Route::delete('/delete/{id}','CommentController@destroy');

});


Route::middleware(['CheckPassword','Check-Auth'])
->namespace('App\Http\Controllers\Api')
->prefix('users')
->group(function () {

  Route::get('/','UserController@index');
  Route::get('/show/{id}','UserController@show');

});


Route::middleware(['CheckPassword','Check-Auth'])
->namespace('App\Http\Controllers\Api')
->prefix('categories')
->group(function () {

  Route::get('/','CategoryController@index');
  Route::get('/show/{id}','CategoryController@show');

});


Route::middleware(['CheckPassword','Check-Auth'])
->namespace('App\Http\Controllers\Api')
->prefix('settings')
->group(function () {

  Route::get('/','SettingController@index');

});

