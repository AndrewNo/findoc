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

Route::post('payer/add', 'PayersController@store');

Route::get('outcomes', 'OutcomesController@index');