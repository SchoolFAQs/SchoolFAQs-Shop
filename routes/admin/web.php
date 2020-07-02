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
Route::domain('admin.'. config('app.domain'))->group(function () {
	// User Login
	Auth::routes();
	Route::middleware(['auth',])->group(function () {
		//Force user to change password on First login
        Route::get('/changepassword','PageController@showChangePasswordForm')->name('changePassword');;
        Route::post('/changepassword','PageController@changePassword')->name('change-password');
        // Default Dashboard
        Route::get('dashboard', 'PageController@dashboard')->name('admin.dashboard');
        Route::get('vieworder', 'PageController@index')->name('page.index');
        Route::resource('store', 'StoreController');

			// Admin Routes
			Route::middleware(['Admin'])->group(function() {
				Route::resource('category', 'CategoriesController');
				Route::resource('products','ProductsController');
			});	
		
			// SuperAdmin Routes
			Route::middleware(['superAdmin'])->group(function() {
				Route::get('vendors/{id}', 'VendorsController@create')->name('vendors.create');
				Route::resource('vendors', 'VendorsController' , ['except' => ['create']]);
				Route::resource('user', 'UserController');
				Route::get('todaysales', 'TotalOrdersController@today_sales')->name('today.sales');
				Route::get('monthsales', 'TotalOrdersController@month_sales')->name('month.sales');
				Route::get('quartersales', 'TotalOrdersController@quarter_sales')->name('quarter.sales');
				Route::get('yearsales', 'TotalOrdersController@year_sales')->name('year.sales');
				Route::resource('totalorders', 'TotalOrdersController');
			});	
			
	});
});
