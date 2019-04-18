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

Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('blog', 'BlogController@index')->name('blog.index');
    Route::get('{slug}', 'BlogController@show')->name('blog.show');
});
