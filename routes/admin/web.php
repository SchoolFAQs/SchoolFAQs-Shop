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
Route::domain('shop.'. config('app.domain'))->group(function () {
	Route::prefix('admin')->group(function () {
		// User Login
		Auth::routes();
		Route::middleware(['auth',])->group(function () {
			//Force user to change password on First login
	        Route::get('/changepassword','PageController@showChangePasswordForm')->name('changePassword');;
	        Route::post('/changepassword','PageController@changePassword')->name('change-password');
	        // Default Dashboard
	        Route::get('/', 'DashboardController@dashboard')->name('admin.dashboard');
	        Route::get('vieworder', 'PageController@index')->name('page.index');
	        Route::resource('products','ProductsController');
	        Route::resource('store', 'StoreController');
	        Route::get('uservendors/{id}', 'VendorsController@create')->name('uservendors.create');
			Route::resource('uservendors', 'VendorsController' , ['except' => ['create']]);
			Route::get('profile/{id}', 'PageController@profile')->name('user.profile');
			//Route::resource('wallet', 'WalletsController');
			Route::get('vendor/wallet/{email}', 'WalletsController@my_wallet')->name('vendor.wallet');
			Route::post('vendor/wallet/withdraw', 'WalletsController@withdraw_request')->name('vendorrequest.wallet');

				// Admin Routes
				Route::middleware(['Admin'])->group(function() {
					Route::resource('category', 'CategoriesController');
					Route::resource('adminmessage', 'AdminMessagesController');
					Route::post('sendmessage', 'AdminMessagesController@send_message')->name('admin.sendmessage');
					Route::resource('applications', 'ApplicationsController');
					Route::get('idcard/{id}', 'ApplicationsController@view_id')->name('applications.idcard');
					Route::get('license/{id}', 'ApplicationsController@view_license')->name('applications.license');
					//Route::get('kyc/{id}', 'ApplicationsController@view_kyc')->name('applications.kyc');
					Route::put('approve/{id}', 'ApplicationsController@approve')->name('applications.approve');
					Route::put('reject/{id}', 'ApplicationsController@reject')->name('applications.reject');
				});	
			
				// SuperAdmin Routes
				Route::middleware(['superAdmin'])->group(function() {
					Route::get('todaysales', 'TotalOrdersController@today_sales')->name('today.sales');
					Route::get('monthsales', 'TotalOrdersController@month_sales')->name('month.sales');
					Route::get('quartersales', 'TotalOrdersController@quarter_sales')->name('quarter.sales');
					Route::get('yearsales', 'TotalOrdersController@year_sales')->name('year.sales');
					Route::get('accountbalance', 'FinancesController@getbalance')->name('account.balance');
					Route::resource('adminproducts','SuperadminProductsController');
					Route::post('adminvendors/rates/save', 'SuperAdminVendorController@save_rate')->name('vendorrate.save');
					Route::get('adminvendors/create/{id}', 'SuperAdminVendorController@create')->name('vendors.create');
					Route::get('adminvendors/{id}', 'SuperAdminVendorController@assign_rate')->name('vendorrate.assign');
					Route::resource('adminvendors', 'SuperAdminVendorController', ['except' => ['create']]);		
					Route::resource('user', 'UserController');
					Route::resource('totalorders', 'TotalOrdersController');
					Route::resource('sms', 'SmsController');
					Route::resource('rates', 'RatesController');
					Route::put('adminwithdrawalapprove{id}', 'SuperadminWithdrawalsController@approve')->name('withdraw.approve');
					Route::put('adminwithdrawalreject{id}', 'SuperadminWithdrawalsController@reject')->name('withdraw.reject');
					Route::resource('adminwithdrawal', 'SuperadminWithdrawalsController');
					
				});	
				
		});
	});
});
