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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/show/{id}', function () {
    if(Auth::check()){
        return view('show-admin');
    }
    else{return redirect('/home');}

});

//all authentication routs must be on top of other routes
Auth::routes();
//Auth routes ends


//Route::post('/new-register', 'Auth\MyRegisterController@userRegister')->name('userRegister');
Route::group(['prefix' => 'data', 'as' => 'data.'], function(){
    Route::resource('/out_patient', 'Admin\OutPatientController');
    Route::resource('/doctor', 'Admin\DoctorController');
    Route::resource('/admin', 'Admin\AdminController');
    Route::resource('/pharmacy', 'Admin\PharmacyController');
    Route::resource('/user', 'UsersController');
    Route::post('/user/profile/image', 'UsersController@uploadImage');
    Route::get('excelDownload/{value}', 'UsersController@excelTemplate');
});

Route::get('/css/adminlte.css.map', function () {
    return redirect('/home');
});


Route::group(['prefix' => 'records', 'as' => 'records.'], function(){
    //admin routes
    Route::resource('/admin', 'AdminController');

    //patients routes
    Route::resource('/out_patient', 'OutPatientController');

    //doctors routes
    Route::resource('/doctor', 'DoctorController');

    //pharmacy routes
    Route::resource('/pharmacy', 'PharmacyController');


});







//should be the last route
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\-/_.]+)?' );
//Route::get('{path}', 'HomeController@index')->where('path', '([A-z]+)?');

