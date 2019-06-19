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
// webhook open api
Route::post('/14k/pull', 'WebhookController@pull'); //webhooks
Route::post('/14k/vue', 'WebhookController@buildVueCil'); //webhooks

// Vultr 接口
Route::group(['namespace'=>'Api\Vultr', 'prefix'=>'vultr'], function () {

    Route::get('info', 'VultrController@info');
    Route::get('app/list', 'VultrController@application');
});
