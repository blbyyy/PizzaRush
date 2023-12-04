<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pizza;
use App\Models\PizzaCrust;
use App\Models\PizzaToppings;

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
    $bestseller = DB::table('pizzas')
        ->join('comments','comments.pizza_id','pizzas.id')
        ->select('pizzas.id','pizzas.name','pizzas.description','pizzas.fee','pizzas.image',DB::raw('ROUND(AVG(rating)) as rating'))
        ->groupBy('pizzas.id','pizzas.name','pizzas.description','pizzas.fee','pizzas.image')
        ->orderBy('pizzas.id','DESC')
        ->get();
    $pizza = Pizza::all();
    $crust = PizzaCrust::all();
    $toppings = PizzaToppings::all();
    return View::make('welcome',compact('pizza', 'crust', 'toppings','bestseller'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', 'HomeController@logout');

Route::get('/announcementss', [
    'uses' => 'AnnouncementController@show',
          'as' => 'announcement.page'
  ]);

Route::view('/contact', 'contact.index');

Route::post('contacts',[
    'uses' => 'ContactController@store',
    'as' => 'messagesent'
]);

Route::get('/pizzarush', [
    'uses' => 'PizzaController@home',
          'as' => 'pizzarush.home'
  ]);

Route::get('/services', [
    'uses' => 'PizzaController@services',
          'as' => 'pizzarush.services'
 ]);

 Route::get('/about', [
    'uses' => 'EmployeeController@listofemployee',
          'as' => 'pizzarush.about'
 ]);

 Route::get('/footer', [
    'uses' => 'PizzaController@pizzacount',
          'as' => 'pizzarush.footer'
 ]);

Route::resource('pizzas', 'PizzaController');
Route::resource('employees', 'EmployeeController');

Route::group(['middleware' => ['auth','role:admin,employee']], function ()
{

    Route::get('/pizzacustomersearchs', [
        'uses' => 'TransactionHistoryController@PizzaCustomerName',
         'as' => 'PizzaCustomerName'
      ]);
    
    Route::get('/pizzacustomersearch/name', [
        'uses' => 'TransactionHistoryController@PizzaSearchCustomer',
         'as' => 'PizzaSearchCustomer'
      ]);
    
    Route::get('/pizzacustomersearch/{id}', 'TransactionHistoryController@PizzaCustomerHistory')->name('show.pizzacustomersearch');
    
    Route::get('/customizecustomersearch/{id}', 'TransactionHistoryController@CustomizeCustomerHistory')->name('show.customizecustomersearch');

    Route::resource('customerss', 'CustomerController')->except(['show']);
    Route::resource('employees', 'EmployeeController');
    Route::resource('employeess', 'EmployeeController');
    Route::resource('pizzass', 'PizzaController');
    Route::resource('announcements', 'AnnouncementController');
    Route::view('/vouchers', 'Voucher.index');
    Route::view('/pizzacrust', 'pizzacrust.index');
    Route::view('/pizzatoppings', 'pizzatoppings.index');
    
    Route::post('/announcementcreate', [
            'uses' => 'AnnouncementController@store1',
            'as' => 'pizzarush.announcementcreate'
     ]);

    Route::get('/announcementlist', [
        'uses' => 'EmployeeController@announcement',
              'as' => 'pizzarush.announcementlist'
     ]);

    Route::get('/employees/editprofile/{id}', 'EmployeeController@editprofile')->name('employee.editprofile');

    Route::put('eupdateprofile/{id}', 'EmployeeController@updateprofile')->name('employee.eupdateprofile');

    //CHARTS
    Route::get('/pizzachart', [
        'uses' => 'ChartController@index',
         'as' => 'pizzachart.index'
      ]);
    
    Route::post('/pizzadate', [
        'uses' => 'ChartController@pizzadate',
         'as' => 'pizzadate.orderdate'
      ]);
    
    Route::view('/orderedpizza', 'charts.pizza');
    
    Route::post('/sales', [
        'uses' => 'ChartController@sales',
         'as' => 'pizzas.sales'
      ]);
    
    Route::view('/pizzasales', 'charts.sales');
    
    Route::get('/crustchart', [
        'uses' => 'ChartController@crust',
         'as' => 'crustchart.crust'
      ]);
    
    Route::get('/toppingschart', [
        'uses' => 'ChartController@toppings',
         'as' => 'toppingschart.toppings'
      ]);
    
});

Route::group(['middleware' => ['auth','role:customer']], function () 
{
    Route::post('/commentcreate', [
        'uses' => 'PizzaController@store1',
        'as' => 'pizzas.store1'
    ]);

    Route::resource('voucherss', 'VouchersController');

    Route::get('/customers/show/{id}', 'CustomerController@show')->name('customers.show');
    
    // PIZZA 

    Route::get('/pizzaindex', [
        'uses' => 'PizzaController@PizzaIndex',
        'as' => 'pizzaindex.index'
    ]);

    //CUSTOMIZED PIZZA

    Route::get('/custompizza', [
        'uses' => 'CustomizedPizzaController@Index',
        'as' => 'custompizza.index'
    ]);

    //CLAIMING OF VOUCHER

    Route::post('claim',[
        'uses' => 'VouchersController@voucherstore',
        'as' => 'claim'
    ]);

    // EDIT CUSTOMER PROFILE

    Route::put('cupdateprofile/{id}', 'CustomerController@updateprofile')->name('customer.cupdateprofile');

    // PIZZA TRANSACTION

    Route::get('pizza_cart', [
        'uses' => 'PizzaController@getCart',
        'as' => 'pizza.shoppingCart'
        ]);
    
    Route::get('pizza_add_to_cart/{id}',[
        'uses' => 'PizzaController@getAddToCart',
        'as' => 'pizza.addToCart'
    ]);
    
    Route::get('pizza_remove/{id}',[
        'uses'=>'PizzaController@getRemoveItem',
        'as' => 'pizza.remove'
    ]);
    
    Route::get('pizzacheckout',[
        'uses' => 'PizzaController@postCheckout',
        'as' => 'pizza.checkouts',
    ]);

    // CUSTOMIZED PIZZA TRANSACTION

    Route::get('custompizza_cart', [
        'uses' => 'CustomizedPizzaController@getCart',
        'as' => 'custompizza.shoppingCart'
        ]);
    
    Route::get('custompizzacheckout',[
            'uses' => 'CustomizedPizzaController@postCheckout',
            'as' => 'custompizza.checkouts',
        ]);
    
    Route::get('add_to_cart/{id}',[
            'uses' => 'CustomizedPizzaController@getAddToCart',
            'as' => 'custompizza.addToCart'
        ]);
    
    
    Route::get('remove/{id}',[
            'uses'=>'CustomizedPizzaController@getRemoveItem',
            'as' => 'custompizza.remove'
        ]);
    
    Route::get('custompizzacheckout',[
            'uses' => 'CustomizedPizzaController@postCheckout',
            'as' => 'custompizza.checkouts',
        ]);

    //VIEWING OF CUSTOMER VOUCHER

    Route::get('/voucherlist', [
            'uses' => 'VoucherController@voucherlist',
            'as' => 'pizzarush.voucherlist'
        ]);

});
