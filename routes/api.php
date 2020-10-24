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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('me', 'AuthController@me');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('logout', 'AuthController@logout');
});


/* 
|--------------------------------------------------------------------------
| Common routes
|--------------------------------------------------------------------------
 */
Route::get('running-server-processes', 'ServerProcessesController@running_list');
Route::post('create-dir', 'ServerDirsController@create_dir');
Route::post('create-file', 'ServerDirsController@create_file');
Route::get('get-list-of-dirs', 'ServerDirsController@get_list_of_dirs');
Route::get('get-list-of-files', 'ServerDirsController@get_list_of_files');