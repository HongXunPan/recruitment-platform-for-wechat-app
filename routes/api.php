<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Recruitment 模块 映射到 \Modules\Recruitment\Http\Controllers\
Route::prefix('recruitment')->namespace('\Modules\Recruitment\Http\Controllers')
    ->middleware(['apiResponse'])
    ->group(function () {
        Route::any('jobList', 'JobController@list');
        Route::get('listFilterCondition', 'JobController@listFilterCondition');
        Route::get('jobDetail/{id}', 'JobController@jobDetail')->where('id', '\d+');

    });
