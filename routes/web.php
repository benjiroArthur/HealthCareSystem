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
Route::post('/admin-login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('/doctor-login', 'Auth\DoctorLoginController@login')->name('doctor.login');

//Auth routes ends

Route::get('/home', 'HomeController@index')->name('home');







//should be the last route
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');
