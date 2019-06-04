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
    Route::post('file/patch_upload', 'OpenController@patch_upload')->name('api.file.patch_upload');
    Route::get('open/bing/pictures', 'OpenController@pictures')->name('api.open.bing.pictures');
    Route::post('open/feedback', 'FeedbackController@store')->name('api.open.feedback');

    // test
    Route::get('system/logs', 'SystemLogController@index')->name('api.system.log.index');
    Route::get('system/logs/{file}', 'SystemLogController@index')->name('api.system.log.file');
    Route::get('system/logs/{file}/tail', 'SystemLogController@tail')->name('api.system.log.file.tail');

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
            'parameters' => ['category' => 'id']
        ]);
        Route::get('category/all', 'CategoryController@all_categories')->name('api.category.all_categories');
        Route::delete('category/batch', 'CategoryController@batch')->name('api.category.batch');

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
            'parameters' => ['tag' => 'id']
        ]);
        Route::get('tag/all', 'TagController@all_tags')->name('api.tag.all_tags');
        Route::delete('tag/batch', 'TagController@batch')->name('api.tag.batch');

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
            'parameters' => ['comment' => 'id']
        ]);

        // video
        Route::resource('video', 'VideoController', [
            'name' => [
                'index' => 'api.video.index',
                'show' => 'api.video.show',
                'store' => 'api.video.store',
                'update' => 'api.video.update',
                'destroy' => 'api.video.destroy',
            ],
            'except' => ['create', 'edit'],
            'parameters' => ['video' => 'id']
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
            'parameters' => ['user' => 'id']
        ]);
        Route::get('user/info', 'UserController@info')->name('api.user.info');
        Route::post('auth/logout', 'AuthController@logout')->name('api.auth.logout');

    });
});
