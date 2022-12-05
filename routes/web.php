<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VlfdataController;
use App\Http\Controllers\VlfimportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChangeRequestController;
use App\Http\Controllers\AppController;

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

Auth::routes();

Route::get('vlfdata', [VlfdataController::class, 'xindex'])->name('vlfdata');
Route::post('vlfdata', [VlfdataController::class, 'storex'])->name('vlfdata');
Route::post('vlfdata', [VlfdataController::class, 'exportCSV'])->name('vlfdata');

Route::post('storevlf', [VlfdataController::class, 'store'])->name('storevlf');
Route::post('editvlf', [VlfdataController::class, 'edit'])->name('editvlf');
Route::post('deletevlf', [VlfdataController::class, 'destroy'])->name('deletevlf');

Route::get('change-request', [ChangeRequestController::class, 'index'])->name('change-request');
Route::get('change-request/create', [ChangeRequestController::class, 'create'])->name('change-request.create');
Route::post('change-request/store', [ChangeRequestController::class, 'store'])->name('change-request.store');
Route::get('change-request/show', [ChangeRequestController::class, 'show'])->name('change-request.show');
Route::get('change-request/destroy', [ChangeRequestController::class, 'destroy'])->name('change-request.destroy');
Route::put('change-request/approval', [ChangeRequestController::class, 'approval'])->name('change-request.approval');
Route::put('change-request/denial', [ChangeRequestController::class, 'denial'])->name('change-request.denial');

Route::get('app', [AppController::class, 'index'])->name('app');
Route::get('app', [AppController::class, 'type'])->name('app');
Route::get('app/lookup/make/{vehicle_type}', [AppController::class, 'make'])->name('app.lookup.make');
Route::get('app/lookup/model/{vehicle_make}', [AppController::class, 'model'])->name('app.lookup.model');
Route::get('app/lookup/fueltype/{vehicle_model}', [AppController::class, 'fuelType'])->name('app.lookup.fueltype');
Route::get('app/lookup/variant/{vehicle_model}/{fuel_type}', [AppController::class, 'variant'])->name('app.lookup.variant');

///////////////////

Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::post('parentdata', [HomeController::class, 'motherChild'])->name('parentdata');
Route::get('/config', 'App\Http\Controllers\ConfigController@index')->name('config');
Route::put('/config/update/{id}', 'App\Http\Controllers\ConfigController@update')->name('config.update');

Route::group(['namespace' => 'App\Http\Controllers\Profile'], function (){ 
	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::put('/profile/update/profile/{id}', 'ProfileController@updateProfile')->name('profile.update.profile');
	Route::put('/profile/update/password/{id}', 'ProfileController@updatePassword')->name('profile.update.password');
	Route::put('/profile/update/avatar/{id}', 'ProfileController@updateAvatar')->name('profile.update.avatar');
});

Route::group(['namespace' => 'App\Http\Controllers\Error'], function (){ 
	Route::get('/unauthorized', 'ErrorController@unauthorized')->name('unauthorized');
});

Route::group(['namespace' => 'App\Http\Controllers\User'], function (){ 
	//Users
	Route::get('/user', 'UserController@index')->name('user');
	Route::get('/user/create', 'UserController@create')->name('user.create');
	Route::post('/user/store', 'UserController@store')->name('user.store');
	Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
	Route::put('/user/update/{id}', 'UserController@update')->name('user.update');
	Route::get('/user/edit/password/{id}', 'UserController@editPassword')->name('user.edit.password');
	Route::put('/user/update/password/{id}', 'UserController@updatePassword')->name('user.update.password');
	Route::get('/user/show/{id}', 'UserController@show')->name('user.show');
	Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user.destroy');
	// Roles
	Route::get('/role', 'RoleController@index')->name('role');
	Route::get('/role/create', 'RoleController@create')->name('role.create');
	Route::post('/role/store', 'RoleController@store')->name('role.store');
	Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
	Route::put('/role/update/{id}', 'RoleController@update')->name('role.update');
	Route::get('/role/show/{id}', 'RoleController@show')->name('role.show');
	Route::get('/role/destroy/{id}', 'RoleController@destroy')->name('role.destroy');
});
