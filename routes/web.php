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

Route::get('/', function () {
    return view('welcome');
});

//all authentication routs must be on top of other routes
Auth::routes();
//Auth routes ends


//Route::post('/new-register', 'Auth\MyRegisterController@userRegister')->name('userRegister');
Route::group(['prefix' => 'data', 'as' => 'data.'], function(){
    Route::resource('/out_patient', 'OutPatientController');
    Route::resource('/doctor', 'DoctorController');
    Route::resource('/admin', 'AdminController');
    Route::resource('/pharmacy', 'PharmacyController');
});







//should be the last route
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\-/_.]+)?' );
//Route::get('{path}', 'HomeController@index')->where('path', '([A-z]+)?');

