<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('41e34ea6-f6f5-47a9-8e00-8300f3d959bb/receiveSMS','UserRequestController@handleUserRequests');
Route::get('41e34ea6-f6f5-47a9-8e00-8300f3d959bb/getReportingData','UserRequestController@getReportingData');
Route::match(['get','post'],'41e34ea6-f6f5-47a9-8e00-8300f3d959bb/botRoute','BotRequestController@handleUserRequests');

