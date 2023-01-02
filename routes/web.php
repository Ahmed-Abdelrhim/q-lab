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

Route::group(['middleware' => 'disable_back_btn'], function () {


    Route::group(['middleware' => ['Install', 'Locale']], function () {
        include('admin.php');
        include('ajax.php');
        include('patient.php');
    });

    Route::get('change_locale/{lang}', 'HomeController@change_locale')->name('change_locale');

    Route::get('clear-cache', function () {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
    });


    Route::get('hash', function () {
        return 'Return Hash Is Done';
    });


// The Prisoner wishes to say a word
// QLab | Patients

//  #	Code	Name	Phone	Email	Total	Paid	Due	Action
//  1	1593914720	patient	+201063955280	osamamohamed2050@gmail.com	0 EGP	0 EGP	0 EGP
//  2	1660042858956	Ahmed	123456789	ahmed@gmail.com	0 EGP	0 EGP	0 EGP
//  3	1667728337683	Rana	123456	Rana@yahoo.com	0 EGP	0 EGP	0 EGP
//  4	1672144252824	Stone Brewer	+1 (453) 858-8547	xopena@mailinator.com	0 EGP	0 EGP	0 EGP
//  6	167214846727	Renee Buckley	+1 (316) 943-2993	nype@mailinator.com	0 EGP	0 EGP	0 EGP


});
