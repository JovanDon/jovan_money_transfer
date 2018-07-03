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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contactlist', 'HomeController@display_contacts_table')->name('contactlist');
Route::get('/createcontact', 'HomeController@display_createcontact_form')->name('createcontact');
Route::get('/createaccount', 'HomeController@display_createaccount_form')->name('createaccount');
Route::post('/sendmoney', 'HomeController@display_sendmoney_form')->name('sendmoney');

