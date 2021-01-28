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

Route::get('/', 'DropzoneController@index');

Route::get('dropzone', 'DropzoneController@index');
Route::post('dropzone/upload', 'DropzoneController@upload')->name('dropzone.upload');
Route::post('dropzone/upload2', 'DropzoneController@upload_chucks')->name('dropzone.upload2');
Route::get('dropzone/fetch', 'DropzoneController@fetch')->name('dropzone.fetch');
Route::get('dropzone/delete', 'DropzoneController@delete')->name('dropzone.delete');

Route::prefix('/chucks')->group(function () {
    Route::post('/upload', 'ChuckUploadController@upload')->name('chucks.upload');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
