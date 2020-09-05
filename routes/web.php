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

Route::get('/', function () {
    return view('welcome');
});

Route::post('changelocale', ['as' => 'changelocale', 'uses' => 'TranslationController@changeLocale']);

Route::get('management/home', 'AdminController@getHomePage');
Route::get('/', 'AdminController@getHomePage');


//Route::get('management/companies/request', 'AdminController@getCompaniesRequest');



//********************* Empresas
Route::resource('management/companies', 'CompanyController');
	// Obtener listado de empresas ajax
	Route::post('companies/getcompanybystatus/{statusId}', 'CompanyController@getCompanyByStatus');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('management/login', 'AuthenticationController@login');

Route::get('logout', 'AuthenticationController@logout');
