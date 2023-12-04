<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/customer/all',['uses' => 'CustomerController@getCustomerAll','as' => 'customer.getcustomerall']);

Route::resource('customer', 'CustomerController');

Route::get('/employee/all',['uses' => 'EmployeeController@getemployeeall','as' => 'employee.getemployeeall'] );

Route::resource('employee', 'EmployeeController');

Route::get('/voucher/all',['uses' => 'VoucherController@getVoucherAll','as' => 'voucher.getVoucherAll'] );

Route::resource('voucher', 'VoucherController');

Route::get('/pizza/all',['uses' => 'PizzaController@getPizzaAll','as' => 'pizza.getPizzaAll'] );

Route::resource('pizza', 'PizzaController');

Route::get('/announcement/all',['uses' => 'AnnouncementController@getAnnouncementAll','as' => 'announcement.getAnnouncementAll'] );

Route::resource('announcement', 'AnnouncementController');

Route::get('/pizzacrust/all',['uses' => 'PizzaCrustController@getPizzaCrustAll','as' => 'pizzacrust.getpizzacrustall'] );

Route::resource('pizzacrust', 'PizzaCrustController');

Route::get('/pizzatoppings/all',['uses' => 'PizzaToppingsController@getPizzaToppingsAll','as' => 'pizzatoppings.getpizzatoppingsall'] );

Route::resource('pizzatoppings', 'PizzaToppingsController');