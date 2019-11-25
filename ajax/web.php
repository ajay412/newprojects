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
	
	
    return view('welcomee');
});

Route::post('alldata', 'Ajaxx@alldata')->name('alldata');
Route::post('savedata', 'Ajaxx@savedata')->name('savedata');
Route::post('deletedata', 'Ajaxx@deletedata')->name('deletedata');
Route::post('updatedata', 'Ajaxx@updatedata')->name('updatedata');
Route::post('editdata', 'Ajaxx@editdata')->name('editdata');
Route::post('updataedataa', 'Ajax@updataedataa')->name('updataedataa');
Route::post('restoredata', 'Ajax@restoredata')->name('restoredata');
Route::post('restoredelete', 'Ajax@restoredelete')->name('restoredelete');
Route::post('getdata', 'Ajax@getdata')->name('getdata');
Route::post('getdataa', 'Ajax@getdataa')->name('getdataa');
//Route::get('view_screening','Ajax@view_screening')->name('view_screening');