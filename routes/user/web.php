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
	Route::get('order/{id}/download/{od}/product', 'OrderController@download')->name('order.download')->middleware('signed');
	Route::get('index/{id}/{od}', 'OrderController@index')->name('index.download')->middleware('signed');
	Route::get('/', 'ClientController@index')->name('welcome');
	Route::post('search', 'ClientController@general_search')->name('search');
	Route::post('categorysearch', 'ClientController@category_search')->name('category.search');
	Route::resource('client', 'ClientController', ['except' => ['index']]);
	Route::get('service/review', 'ClientController@review')->name('store.remove');
	Route::resource('order', 'OrderController', ['except' => ['index']]);
	Route::resource('contact', 'ContactController');
	Route::get('apply', 'ClientController@vendor_apply')->name('vendor.apply');
	Route::post('apply', 'ClientController@vendor_application')->name('vendor.application');
	Route::post('payment', 'PaymentsController@requesttopay')->name('client.pay');
	//Route::get('payment/confirm/', 'PaymentsController@checkpayment')->name('client.payment');
	
});