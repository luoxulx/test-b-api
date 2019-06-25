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

// Vultr 接口: 仅指定 IP 可调用
Route::group(['namespace'=>'Api\Vultr', 'prefix'=>'vultr'], function () {

    Route::get('account/info', 'VultrController@accountInfo');
    Route::get('app/list', 'VultrController@applications');
    Route::get('auth/info', 'VultrController@authInfo');
    Route::get('backup/list', 'VultrController@backupList');
    Route::get('baremetal/bandwidth', 'VultrController@bandwidth');
    Route::get('baremetal/get_app_info', 'VultrController@getAppInfo');
    Route::get('baremetal/list', 'VultrController@serverList');
});
