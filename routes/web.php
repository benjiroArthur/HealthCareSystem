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
Route::post('/new-register', 'Auth\MyRegisterController@userRegister')->name('userRegister');
Route::get('/user-logout', 'Auth\LoginController@userlogout')->name('user.logout');
Route::post('/admin-login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('/doctor-login', 'Auth\DoctorLoginController@login')->name('doctor.login');
Route::get('/admin-logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/doctor-logout', 'Auth\DoctorLoginController@logout')->name('doctor.logout');

//Auth routes ends

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/doctor-home', 'DoctorHomeController@index')->name('doctor-home');
//Route::get('/admin-home', 'AdminHomeController@index')->name('admin-home');







//should be the last route
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\-/_.]+)?');
//Route::get('{path}', 'HomeController@index')->where('path', '([A-z]+)?');
