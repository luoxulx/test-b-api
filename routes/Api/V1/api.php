<?php

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

Route::group(['middleware' => 'validate.input'], function () {
    /** ---------- open api start---------- */
    Route::post('auth/login', 'AuthController@login')->name('api.auth.login');

    Route::post('file/upload', 'OpenController@upload')->name('api.file.upload');
    Route::post('file/chunk_upload', 'OpenController@chunk_upload')->name('api.file.chunk_upload');

    /** ---------- open api end---------- */

    Route::group(['middleware' => 'auth:api'], function () {
        Route::pattern('id', '[0-9]+');
        /** ---------- article start---------- */
        Route::resource('article', 'ArticleController', [
            'name' => [
                'index' => 'api.article.index',
                'show' => 'api.article.show',
                'store' => 'api.article.store',
                'update' => 'api.article.update',
                'destroy' => 'api.article.destroy',
            ],
            'except' => ['create', 'edit'],
            'parameters' => ['article' => 'id']
        ]);
        Route::delete('article/batch', 'ArticleController@batch')->name('api.article.batch');
        /** ---------- article end---------- */

        // category
        Route::resource('category', 'CategoryController', [
            'name' => [
                'index' => 'api.category.index',
                'show' => 'api.category.show',
                'store' => 'api.category.store',
                'update' => 'api.category.update',
                'destroy' => 'api.category.destroy',
            ],
            'except' => ['create', 'edit'],
            'parameters' => ['article' => 'id']
        ]);

        // tag
        Route::resource('tag', 'TagController', [
            'name' => [
                'index' => 'api.tag.index',
                'show' => 'api.tag.show',
                'store' => 'api.tag.store',
                'update' => 'api.tag.update',
                'destroy' => 'api.tag.destroy',
            ],
            'except' => ['create', 'edit'],
            'parameters' => ['article' => 'id']
        ]);

        // comment
        Route::resource('comment', 'CommentController', [
            'name' => [
                'index' => 'api.comment.index',
                'show' => 'api.comment.show',
                'store' => 'api.comment.store',
                'update' => 'api.comment.update',
                'destroy' => 'api.comment.destroy',
            ],
            'except' => ['create', 'edit'],
            'parameters' => ['article' => 'id']
        ]);

        // user
        Route::resource('user', 'UserController', [
            'name' => [
                'index' => 'api.user.index',
                'show' => 'api.user.show',
                'store' => 'api.user.store',
                'update' => 'api.user.update',
                'destroy' => 'api.user.destroy',
            ],
            'except' => ['create', 'edit'],
            'parameters' => ['article' => 'id']
        ]);
        Route::get('user/info', 'UserController@info')->name('api.user.info');
        Route::post('auth/logout', 'AuthController@logout')->name('api.auth.logout');

    });
});
