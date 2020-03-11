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


Route::group(['middleware' => ['role']], function () {
    Route::get('/user.list','UserController@index')->name('user.list');
    Route::get('/user.show/{id}','UserController@show')->name('user.show');
    Route::get('/user.add','UserController@add')->name('user.show.add');
    
    Route::post('/user.add','UserController@store')->name('user.add');
    Route::get('/user.delete/{id}','UserController@destroy')->name('user.delete');
    Route::post('/user.update','UserController@update')->name('user.update');
    
    
    Route::get('/document.add','DocumentController@add')->name('document.show.add');
    Route::get('/document.list','DocumentController@index')->name('document.list');
    Route::get('/document.show/{id}','DocumentController@show')->name('document.show');
    Route::get('/document.download/{file}','DocumentController@download')->name('document.download');
    Route::post('/document.update','DocumentController@update')->name('document.update');
    Route::post('/document.add','DocumentController@store')->name('document.add');
});

Route::get('/document.delete/{id}','DocumentController@destroy')->name('document.delete');
//Usuario
Route::get('/document','DocumentController@userAddDocument')->name('document.usernormal');
Route::post('/document','DocumentController@addDocument')->name('document.add.usernormal');
Route::get('/document/list','DocumentController@listMyDocuments')->name('document.list.usernormal');
Route::get('/document/show/{id}','DocumentController@showDocument')->name('document.show.usernormal');
Route::post('/document/update','DocumentController@updateDocument')->name('document.update.usernormal');

