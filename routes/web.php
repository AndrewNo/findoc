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

Route::get('/', function (){
    return view('index');
});

Route::get('accounts', 'AccountsController@index');
Route::post('account/add', 'AccountsController@store');
Route::post('account/add', 'AccountsController@store');
Route::post('account/non-active', 'AccountsController@nonActive');
Route::get('account/{account}', 'AccountsController@edit');
Route::post('account/update/{account}', 'AccountsController@update');
Route::delete('account/destroy/{account}', 'AccountsController@destroy');

Route::get('incomes', 'IncomesController@index');
Route::post('income/add', 'IncomesController@store');
Route::delete('income/destroy/{income}', 'IncomesController@destroy');
Route::get('income/{income}', 'IncomesController@edit');
Route::post('income/update/{income}', 'IncomesController@update');

Route::post('category/add', 'CategoriesController@store');

Route::post('subcategory/add', 'SubcategoriesController@store');
Route::post('subcategory/get', 'SubcategoriesController@getSubcategories');

Route::post('payer/add', 'PayersController@store');

Route::post('seller/add', 'SellersController@store');

Route::get('outcomes', 'OutcomesController@index');
Route::post('outcome/add', 'OutcomesController@store');
Route::delete('outcome/destroy/{outcome}', 'OutcomesController@destroy');
Route::get('outcome/{outcome}', 'OutcomesController@edit');
Route::post('outcome/update/{outcome}', 'OutcomesController@update');

Route::get('transfers', 'TransfersController@index');
Route::post('transfer/add', 'TransfersController@store');
Route::delete('transfer/destroy/{transfer}', 'TransfersController@destroy');
Route::get('transfer/{transfer}', 'TransfersController@edit');