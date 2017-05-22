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
Route::post('income/date', 'IncomesController@getByDate');

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
Route::post('outcome/date', 'OutcomesController@getByDate');

Route::get('transfers', 'TransfersController@index');
Route::post('transfer/add', 'TransfersController@store');
Route::delete('transfer/destroy/{transfer}', 'TransfersController@destroy');
Route::get('transfer/{transfer}', 'TransfersController@edit');
Route::post('transfer/update/{transfer}', 'TransfersController@update');
Route::post('transfer/date', 'TransfersController@getByDate');

Route::get('debts', 'DebtsController@index');
Route::post('debt/add', 'DebtsController@store');
Route::delete('debt/destroy/{debt}', 'DebtsController@destroy');
Route::get('debt/{debt}', 'DebtsController@edit');
Route::post('debt/update/{debt}', 'DebtsController@update');

Route::post('agent/add', 'AgentsController@store');

Route::get('categories', 'CategoriesController@index');
Route::delete('category/destroy/{category}', 'CategoriesController@destroy');
Route::get('category/{category}', 'CategoriesController@edit');
Route::post('category/update/{category}', 'CategoriesController@update');

Route::get('subcategories', 'SubcategoriesController@index');
Route::delete('subcategory/destroy/{subcategory}', 'SubcategoriesController@destroy');
Route::get('subcategory/{subcategory}', 'SubcategoriesController@edit');
Route::post('subcategory/update/{subcategory}', 'SubcategoriesController@update');

Route::get('sellers', 'SellersController@index');
Route::delete('seller/destroy/{seller}', 'SellersController@destroy');
Route::get('seller/{seller}', 'SellersController@edit');
Route::post('seller/update/{seller}', 'SellersController@update');

Route::get('payers', 'PayersController@index');
Route::delete('payer/destroy/{payer}', 'PayersController@destroy');
Route::get('payer/{payer}', 'PayersController@edit');
Route::post('payer/update/{payer}', 'PayersController@update');

Route::get('agents', 'AgentsController@index');
Route::delete('agent/destroy/{agent}', 'AgentsController@destroy');
Route::get('agent/{agent}', 'AgentsController@edit');
Route::post('agent/update/{agent}', 'AgentsController@update');