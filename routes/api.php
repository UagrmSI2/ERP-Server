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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>'auth:api'],function(){
    Route::put('createPassword','UserController@createPassword');
    Route::post('country','CountryController@post');
    Route::get('user','UserController@getUser');
    Route::post('user','UserController@new');
    Route::post('newPurchase','PurchaseController@setNew');
    Route::get('purchases','PurchaseController@getAll');
    Route::get('activities','ActivityController@getAll');
    //------------------Venta----------------------------------
    Route::post('newSale','SaleController@setNew');
    Route::get('sales','SaleController@getAll');
    //------------------Reporte---------------------------------
    Route::get('reportBillPurchase','ReportController@reportPurchaseBills');
    Route::get('reportBillSale','ReportController@reportSaleBills');
    Route::get('reportPurchaseNotes','ReportController@reportPurchaseNotes');
    Route::get('reportSaleNotes','ReportController@reportSaleNotes');
    Route::get('reportSaleMes','ReportController@reportSaleMes');
    Route::get('reportPurchaseMes','ReportController@reportPurchaseMes');
});
Route::post('login','UserController@login');
Route::get('users','UserController@getAll');







//---------------------Crud Proveedores---------------

Route::post('provider','ProviderController@post');
Route::put('provider/update/{id}','ProviderController@put');
Route::get('providers','ProviderController@get');
Route::delete('provider/delete/{id}','ProviderController@delete');

//----------------------Crud Categorias---------------
Route::get('categories','CategoryController@read');
Route::post('category','CategoryController@create');
Route::put('category/{id}','CategoryController@update');
Route::delete('category/{id}','CategoryController@destroy');

//-----------------------Crud Productos-----------------
Route::get('products','ProductController@read');
Route::post('product','ProductController@create');
Route::put('product/{id}','ProductController@update');
Route::delete('product/{id}','ProductController@destroy');

//------------------------Crud Paises----------------------
Route::get('countries','CountryController@get');

Route::put('country/{id}','CountryController@put');
Route::delete('country/{id}','CountryController@delete');

//----------------------Crud Ciudades-----------------

Route::get('cities','CityController@getAll');
Route::post('city','CityController@post');
Route::put('city/{id}','CityController@put');
Route::delete('city/{id}','CityController@delete');

//------------------Crud Sucursales---------------------

Route::get('offices','OfficeController@get');
Route::post('office','OfficeController@post');
Route::put('office/{id}','OfficeController@put');
Route::delete('office/{id}','OfficeController@delete');

//------------------Crud Depositos---------------------

route::get('deposits','DepositController@get');
route::post('deposit','DepositController@post');
route::put('deposit/{id}','DepositController@put');
route::delete('deposit/{id}','DepositController@delete');

//------------------Crud Clientes---------------------
Route::post('client','ClientController@post');
Route::get('clients','ClientController@getAll');

//------------------Crud Departamentos---------------------
Route::get('departaments','DepartamentController@getAll');
Route::post('departament','DepartamentController@post');

Route::get('roles','RoleController@getAll');

Route::get('payments','SaleController@getPago');


