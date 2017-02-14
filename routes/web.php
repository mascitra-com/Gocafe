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

// DUMMIES VIEW
Route::get('ui/', 'Ui@Index');
Route::get('ui/dashboard', 'Ui@Dashboard');
Route::get('ui/login', 'Ui@Login');
Route::get('ui/profile', 'Ui@Profile');
Route::get('ui/cafe', 'Ui@Cafe');
Route::get('ui/staff', 'Ui@Staff');
Route::get('ui/staff/add', 'Ui@Staff_create');
Route::get('ui/staff/detail', 'Ui@Staff_detail');
Route::get('ui/branch', 'Ui@Branch');
Route::get('ui/branch/detail', 'Ui@Branch_detail');
Route::get('ui/position', 'Ui@Position');
Route::get('ui/account', 'Ui@Account');
Route::get('ui/menu', 'Ui@Menu');
Route::get('ui/menu/add', 'Ui@Menu_create');
Route::get('ui/kategori', 'Ui@Kategori');
