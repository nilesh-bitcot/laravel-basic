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

Route::get('/', 'HomeController@index');

Route::post('/create', 'MessageController@create');

Route::get('/message/{id}', 'MessageController@view');

Route::get('/delete/{id}', 'MessageController@delete');

Route::post('/update', 'MessageController@update');

// Route::get('/upload', 'UploadController@upload')->name('upload');
// Route::get('/download, 'UploadController@download)->name(‘download');
// Route::post('/process', 'UploadController@process')->name('process');
// Route::get('/list', 'UploadController@list')->name('list');