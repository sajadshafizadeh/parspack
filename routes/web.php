<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get-dir-name', 'ServerDirsController@get_dir_name');
Route::get('/get-file-name', 'ServerDirsController@get_file_name');



/* 
|--------------------------------------------------------------------------
| Common routes
|--------------------------------------------------------------------------
 */
Route::get('running-server-processes', 'ServerProcessesController@running_list');
Route::post('create-dir', 'ServerDirsController@create_dir')->name('create-dir');
Route::post('create-file', 'ServerDirsController@create_file')->name('create-file');
Route::get('get-list-of-dirs', 'ServerDirsController@get_list_of_dirs')->name('get-list-of-dirs');
Route::get('get-list-of-files', 'ServerDirsController@get_list_of_files')->name('get-list-of-files');
