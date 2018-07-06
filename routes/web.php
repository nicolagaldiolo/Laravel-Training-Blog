<?php

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

//Route::get('/', 'TasksController@index');
//Route::get('tasks/{tasks}', 'TasksController@show');

/*
Route::get('/', 'PostController@index');
//Route::get('posts/{post}', 'PostController@show')->where('post', '[0-9]+')->name('posts.show');
Route::get('posts/create', 'PostController@create')->name('posts.create')->middleware('auth');
Route::get('posts/{post}', 'PostController@show')->name('posts.show');
Route::get('posts/{post}/edit', 'PostController@edit')->name('posts.edit');
Route::patch('posts/{post}', 'PostController@update')->name('posts.update');
Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');
Route::post('posts', 'PostController@store')->name('posts.store')->middleware('auth');
*/

Route::get('/', 'PostController@index')->name('posts.index');

Route::resource('posts', 'PostController')->except('index'); // creo la risorsa ma escludo alcuni metodi

// Route::resource('posts.comments', 'CommentsController')->only('store', 'update', 'delete');
// creare
// Route::post('posts/{post}/comments', 'CommentsController@store');
// Route::patch('posts/{post}/comments/{comment}', 'CommentsController@udpate');
// Route::delete('posts/{post}/comments/{comments}', 'CommentsController@destroy');
// cancellare
// Route::get('deploy-webhook', 'GihubController@deply')
// Route::get('rebase-webhook', 'GihubController@rebase')

Auth::routes();

Route::get('category/{category}', 'CategoryController@show')->name('categories.show');

Route::get('/home', 'HomeController@index')->name('home');