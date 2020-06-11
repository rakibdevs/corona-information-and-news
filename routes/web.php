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

Route::get('/', 'PagesController@index');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['prefix' => 'admin/','middleware' => 'auth'], function(){


	Route::get('/', 'HomeController@index')->name('dashboard');

	Route::get('collection/', 'CollectionController@index');
	Route::get('get-collection','CollectionController@getCollections');
	Route::post('collection/store', 'CollectionController@store');
	Route::get('collection/update', 'CollectionController@update');
	Route::get('collection/delete/{id}', 'CollectionController@destroy');

	Route::get('expense/', 'ExpenseController@index');
	Route::get('get-expense','ExpenseController@getExpenses');
	Route::post('expense/store', 'ExpenseController@store');
	Route::get('expense/update', 'ExpenseController@update');
	Route::get('expense/delete/{id}', 'ExpenseController@destroy');

	Route::get('gallery/', 'GalleryController@index');
	Route::post('gallery/store', 'GalleryController@store');
});
