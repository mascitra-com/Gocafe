<?php

Route::get('/dashboard', 'AdminDashboardController@index');

//ADS
Route::resource('ads', 'AdsController');
Route::get('ads/delete/{id}', 'AdsController@delete');
Route::get('adsBanner/{id}', 'AdsController@showBanner');
//-END ADS

//INFORMATION
Route::get('info', 'InformationController@index');
Route::get('info/create', 'InformationController@create');
Route::get('info/{infoId}/edit', 'InformationController@edit');
Route::post('info', 'InformationController@store');
Route::patch('info/{infoId}', 'InformationController@update');
Route::get('info/destroy/{infoId}', 'InformationController@destroy');
Route::get('info/activate/{infoId}', 'InformationController@activate');
Route::get('info/deactivate/{infoId}', 'InformationController@deactivate');
//-END INFORMATION