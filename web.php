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
Route::get('admin','Doctor@login')->name('admin');
Route::post('admin_login','Doctor@admin_login')->name('admin_login');
Route::get('doctor_registration', 'Doctor@signup')->name('doctor_registration');
Route::post('doctor_signup','Doctor@doctor_signup');
Route::group( [ 'middleware' => 'admincheck']	, function()
{
Route::get('dashboard','Doctor@dashboard')->name('dashboard');
Route::get('doctorlist','Doctor@doctorlist')->name('doctorlist');
Route::get('logout','Doctor@logout')->name('logout');
Route::get('delete/{id}', 'Doctor@delete')->name('delete');
Route::get('block/{id}', 'Doctor@block')->name('block');
Route::get('unblock/{id}', 'Doctor@unblock')->name('unblock');
Route::get('add_doctor', 'Doctor@add_doctor')->name('add_doctor');
Route::post('doctor_add','Doctor@doctor_add')->name('doctor_add');
Route::get('refresh_device_id/{id}','Doctor@refresh_device_id')->name('refresh_device_id');
Route::get('view_patient/{id}','Doctor@view_patient')->name('view_patient');
Route::get('view_screening/{id}','Doctor@view_screening')->name('view_screening');

});