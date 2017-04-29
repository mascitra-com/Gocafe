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
		return redirect('dashboard');
	});


	Auth::routes();

	Route::get('/home', 'HomeController@index');
    // CAFE
	Route::resource('/profile/cafe', 'CafeController');
	Route::patch('/profile/cafe/updateContact/{contact}', 'CafeController@updateContact');
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
    Route::get('menus/showThumbnail/{id}', 'MenusController@showThumbnail'); //get avatar's response
    Route::get('menus/showImage/{image_file}', 'MenusController@showImage'); //get avatar's response
    Route::get('menus/getMenus/{idCategory}', 'MenusController@getMenus');
    Route::get('menus/getMenu/{idMenu}', 'MenusController@getMenu');
    //--END CAFE'S MENU

	//MENU'S CATEGORY
	Route::resource('categories', 'CategoryMenusController');
	Route::get('categories/refresh', 'CategoryMenusController@getAllCategory');
	Route::post('categories/add', 'CategoryMenusController@add');
	//--END MENU'S CATEGORY

	//CAFE'S PACKAGE
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
    Route::get('chart', 'ReportController@chart');
    Route::get('report', 'ReportController@index');
    Route::get('report/detail/{transactionId}', 'ReportController@detail');
    Route::get('revenue', 'ReportController@revenue');
    Route::get('filter_report/{startDate}/{endDate}/{paymentType}', 'ReportController@report_filter');
    //--END TRANSACTION

    //REVIEW
    Route::post('review', 'ReviewController@store');
    //--END REVIEW
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
Route::get('ui/promo', 'Ui@Promo');
Route::get('ui/promo/add', 'Ui@Promo_create');
Route::get('ui/package', 'Ui@Package');
Route::get('ui/package/add', 'Ui@Package_create');
Route::get('ui/discount', 'Ui@Discount');
