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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'HomeController@index');

    Route::resource('blog', 'BlogController', [
        'names' => ['index' => 'blog.index', 'show' => 'blog.show',],
        'except' => ['create', 'edit', 'store', 'update', 'destroy']
    ]);
});
