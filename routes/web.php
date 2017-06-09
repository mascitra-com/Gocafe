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

	Route::get('/', 'HomeController@index');

	Auth::routes();

    // CAFE
	Route::resource('/profile/cafe', 'CafeController');
	Route::patch('/profile/cafe/updateContact/{contact}', 'CafeController@updateContact');
    Route::get('logo/{id}', 'CafeController@showLogo'); //get avatar's response
    Route::get('cover/{id}', 'CafeController@showCover'); //get avatar's response
    Route::post('logo/replace/{id}', 'CafeController@updateLogo');
    Route::post('cover/replace/{id}', 'CafeController@updateCover');
    //--END CAFE

    // BRANCH
	Route::resource('/branch', 'BranchController');
	Route::post('/branch/getCitiesByProvince', 'BranchController@getCitiesByProvince');
	Route::post('/branch/getDistrictByCity', 'BranchController@getDistrictByCity');
    //--END BRANCH

    //DASHBOARD
	Route::get('dashboard', 'DashboardController@index');
    //--END DASHBOARD

	//PROFILE
	Route::get('profile', 'ProfileController@edit');
	Route::patch('profile/personal/{id}', 'ProfileController@updatePersonal');
	Route::patch('profile/contact/{id}', 'ProfileController@updateContact');
	Route::get('profile/avatar', [
		'as' => 'getAvatar', 'uses' => 'ProfileController@showAvatar']); //get avatar's response
	Route::post('profile/avatar/replace/{id}', 'ProfileController@updateAvatar');
	Route::put('profile/avatar/change/{id}', 'ProfileController@updateAvatarName');
	//--END PROFILE

	//STAFF
	Route::get('staff/download', 'StaffController@downloadExcel');
	Route::resource('staff', 'StaffController');
	Route::post('staff/import', 'StaffController@importExcel');
	//--END STAFF

	//CAFE'S MENU
	Route::resource('menus', 'MenusController');
    Route::get('menus/getMenus/{idCategory}', 'MenusController@getMenus');
    Route::get('menus/getMenu/{idMenu}', 'MenusController@getMenu');
    //--END CAFE'S MENU

	//MENU'S CATEGORY
	Route::resource('categories', 'CategoryMenusController');
	Route::get('categories/refresh', 'CategoryMenusController@getAllCategory');
	Route::post('categories/add', 'CategoryMenusController@add');
	//--END MENU'S CATEGORY

	//CAFE'S PACKAGE
    Route::get('packages/getPackages', 'PackagesController@getPackages');
    Route::get('packages/getPackage/{packageId}', 'PackagesController@getPackage');
    Route::resource('packages', 'PackagesController');
    Route::get('packages/package_image/{id}', 'PackagesController@showImage'); //get avatar's response
	//--END CAFE'S PACKAGE

	//PROMO
    Route::resource('discount', 'DiscountController');
    Route::get('discount/deactivate/{id}', 'DiscountController@deactivate');
    //--END PROMO

    //DISCOUNTS
    Route::get('batch_discount', 'BatchDiscountsController@index');
    Route::post('batch_discount', 'BatchDiscountsController@batch');
    //--END DISCOUNTS

    //TRANSACTION
    Route::get('payment', 'TransactionController@payment');
    Route::post('payment', 'TransactionController@store');
    Route::patch('payment/{paymentId}', 'TransactionController@update');
    Route::get('order', 'TransactionController@order');
    Route::post('order', 'TransactionController@store');
    Route::get('transaction/getMenusByTableNumber/{transactionId}', 'TransactionController@getMenusByTableNumber');
    Route::get('transaction/getReviews/{itemId}', 'TransactionController@getReviewsByItemId');
    //--END TRANSACTION

    // REPORT
    Route::get('chart', 'ReportController@chart');
    Route::get('report', 'ReportController@index');
    Route::get('report/detail/{transactionId}', 'ReportController@reportDetail');
    Route::get('revenue', 'ReportController@revenue');
    Route::get('revenue/detail/{transactionId}', 'ReportController@revenueDetail');
    Route::get('filter_report/{startDate}/{endDate}/{paymentType}', 'ReportController@report_filter');
    Route::get('filter_revenue/{startDate}/{endDate}/{paymentType}', 'ReportController@revenue_filter');
    //--END REPORT

    // REVIEW
    Route::post('review', 'ReviewController@store');
    //--END REVIEW

});
// Thumbnail & Image
Route::get('menus/showThumbnail/{id}', 'MenusController@showThumbnail');
Route::get('menus/showImage/{image_file}', 'MenusController@showImage');

//HOMEPAGE
Route::get('get-provinces', 'HomeController@getAllProvincesForSearch');
//--END HOMEPAGE

//SHOP
Route::get('recommended-shop', 'ShopController@recommended');
Route::get('load-recommended/{offset}', 'ShopController@load');
Route::get('shop/{cafeId}', 'ShopController@detail');
Route::get('shop/allProducts/{cafeId}', 'ShopController@allProducts');
Route::get('search/shop', ['as' => 'search', 'uses' => 'ShopController@search']);
//--END SHOP

//PRODUCT
Route::get('search', ['as' => 'search', 'uses' => 'ProductController@search']);
Route::get('product/{productId}', 'ProductController@detail');
//--END PRODUCT

//MAIL
Route::get('idea-box', 'HomeController@ideaBox');
//-END MAIL

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