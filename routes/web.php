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


Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });


    Auth::routes();

    Route::get('/home', 'HomeController@index');

    Route::resource('/profile/cafe', 'CafeProfileController');
    Route::patch('/profile/cafe/updateContact/{contact}', 'CafeProfileController@updateContact');

    Route::resource('/branch', 'BranchController');
    Route::post('/branch/getCitiesByProvince', 'BranchController@getCitiesByProvince');
    Route::post('/branch/getDistrictByCity', 'BranchController@getDistrictByCity');

    Route::get('/home', 'HomeController@index');

    //DASHBOARD
    Route::get('dashboard', 'DashboardController@index');

    //PROFILE
    Route::get('profile', 'ProfileController@edit');
    Route::patch('profile/personal/{id}', 'ProfileController@updatePersonal');
    Route::patch('profile/contact/{id}', 'ProfileController@updateContact');
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
