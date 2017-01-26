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

Auth::routes();

Route::get('/home', 'HomeController@index');

// DUMMIES VIEW
Route::get('ui/dashboard', 'Ui@Dashboard');
Route::get('ui/login', 'Ui@Login');
Route::get('ui/profile', 'Ui@Profile');
