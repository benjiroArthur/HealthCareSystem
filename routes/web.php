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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $tip = \App\DailyTips::latest()->first();
    return view('welcome')->with('tip', $tip);
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
    Route::post('/user/status-update/{id}', 'UsersController@statusUpdate');
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

    //contact us routes
    Route::resource('/contact', 'ContactUsController');

    //contact list routes
    Route::resource('/friends', 'FriendsController');

    //specialization list routes
    Route::resource('/specialization', 'SpecializationController');

    //Prescription list routes
    Route::resource('/prescription', 'PrescriptionController');
    Route::get('/allPrescription/{id}', 'PrescriptionController@allPrescription');
    Route::put('/drug/dispense/{id}', 'PrescriptionController@despenseDrug');




    Route::resource('/medical-records', 'MedicalRecordsController');
    Route::get('/medical-records/patient/{id}', 'MedicalRecordsController@searchMedicalRecords');

    //messages route
    Route::resource('/messages', 'MessagesController');
    Route::get('/messages/chat/{id}', 'MessagesController@getMessagesFor');

    //dailyTips routes
    Route::resource('/daily-tips', 'DailyTipController');
    Route::get('/latest-tips', 'DailyTipController@getLatest');

    //password Update
    Route::post('/password/update/{id}', 'UsersController@passwordUpdate');


});


//admin dashboard
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function(){
    //admin routes
    Route::get('/new/out_patient', 'Admin\DashboardController@getOutPatient');

    //patients routes
    Route::get('/new/doctor', 'Admin\DashboardController@getDoctor');

    //doctors routes
    Route::get('/new/pharmacy', 'Admin\DashboardController@getPharmacy');

    //pharmacy routes
    Route::get('/new/admin', 'Admin\DashboardController@getAdmin');

    //stat route
    Route::get('/statistics', 'Admin\DashboardController@getStat');

    Route::get('/sliders', 'SliderController@index');



});





//should be the last route
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\-/_.]+)?' );
//Route::get('{path}', 'HomeController@index')->where('path', '([A-z]+)?');

