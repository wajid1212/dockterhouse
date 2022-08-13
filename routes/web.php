<?php

use App\Http\Middleware\UserAuth;
use Illuminate\Support\Facades\DB;
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

Route::get('/', 'UserAuthController@index')->name('home');
Route::post('login', 'UserAuthController@login')->name('login');



Route::middleware([UserAuth::class])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('logout', 'UserAuthController@logout')->name('logout');
        Route::get('home', 'AdminController@index')->name('admin.home');
        Route::get('patient-list', 'AdminController@getPatients')->name('patient.list');
        Route::post('store-patient', 'AdminController@storePatient')->name('store.patient');
    });
});




