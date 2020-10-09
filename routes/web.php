<?php

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

Auth::routes(['register' => true]);

//Protected routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    //Contact
    Route::get('/contacts', 'ContactController@index');
    Route::post('/contact', 'ContactController@store');
    Route::put('/contact', 'ContactController@update');
    Route::delete('/contact', 'ContactController@destroy');
    Route::group(['middleware' => 'checkId'], function () {
        Route::get('/contact/{id}', 'ContactController@getbyid');
    });

});
