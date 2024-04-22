<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth:admin','Lang','Authorize'])
->namespace('App\Http\Controllers\Dashboard')
->prefix('admin')
->group(function () {

     Route::get('/dashboard','HomeController@index')->name('home');
     Route::get('/search','HomeController@search')->name('search');
     Route::get('/profile/show','ProfileController@show')->name('profile.show');
     Route::get('/profile/edit','ProfileController@edit')->name('profile.edit');
     Route::put('/profile/update/{id}','ProfileController@update')->name('profile.update');
     Route::get('/language/{locale}', 'LanguageController@changeLanguage')->name('change.language');
     Route::get('/search','HomeController@search')->name('search');

                       // Users

     Route::get('/users','UserController@index')->name('users.index');
     Route::get('/users/create','UserController@create')->name('users.create');
     Route::post('/users/store','UserController@store')->name('users.store');
     Route::get('/users/edit/{id}','UserController@edit')->name('users.edit');
     Route::put('/users/update/{id}','UserController@update')->name('users.update');
     Route::get('/users/show/{id}','UserController@show')->name('users.show');
     Route::delete('/users/destroy/{id}','UserController@destroy')->name('users.destroy');

                 // categories
     Route::get('/categories','CategoryController@index')->name('categories.index');
     Route::get('/categories/create','CategoryController@create')->name('categories.create');
     Route::post('/categories/store','CategoryController@store')->name('categories.store');
     Route::get('/categories/edit/{id}','CategoryController@edit')->name('categories.edit');
     Route::put('/categories/update/{id}','CategoryController@update')->name('categories.update');
     Route::get('/categories/show/{id}','CategoryController@show')->name('categories.show');
     Route::delete('/categories/destroy/{id}','CategoryController@destroy')->name('categories.destroy');
     Route::get('/categories/trashed', 'CategoryController@trashed')->name('categories.trash');
     Route::put('/categories/restore/{id}', 'CategoryController@restore')->name('categories.restore');
     Route::delete('/categories/delete/{id}', 'CategoryController@delete')->name('categories.delete');

                 // posts

     Route::get('/posts','PostController@index')->name('posts.index');
     Route::get('/posts/create','PostController@create')->name('posts.create');
     Route::post('/posts/store','PostController@store')->name('posts.store');
     Route::get('/posts/edit/{id}','PostController@edit')->name('posts.edit');
     Route::put('/posts/update/{id}','PostController@update')->name('posts.update');
     Route::get('/posts/show/{id}','PostController@show')->name('posts.show');
     Route::delete('/posts/destroy/{id}','PostController@destroy')->name('posts.destroy');
     Route::get('/posts/trashed', 'PostController@trashed')->name('posts.trash');
     Route::put('/posts/restore/{id}', 'PostController@restore')->name('posts.restore');
     Route::delete('/posts/delete/{id}', 'PostController@delete')->name('posts.delete');

                    // settings

     Route::get('/settings','SettingController@index')->name('settings.index');
     Route::get('/settings/create','SettingController@create')->name('settings.create');
     Route::post('/settings/store','SettingController@store')->name('settings.store');
     Route::get('/settings/edit/{id}','SettingController@edit')->name('settings.edit');
     Route::put('/settings/update/{id}','SettingController@update')->name('settings.update');
     Route::get('/settings/show/{id}','SettingController@show')->name('settings.show');
     Route::delete('/settings/destroy/{id}','SettingController@destroy')->name('settings.destroy');

});


Auth::routes();

