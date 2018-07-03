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
Route::get('/contactlist', 'Contacts@display_contacts_list')->name('contactlist');
Route::get('/createcontact', 'HomeController@display_createcontact_form')->name('createcontact');
Route::get('/createaccount', 'HomeController@display_createaccount_form')->name('createaccount');
Route::post('/sendmoney', 'HomeController@display_sendmoney_form');
Route::post('/addcontact', 'Contacts@create_contact');
Route::post('/updatecontact', 'Contacts@update_contact');
Route::post('/editcontact', 'Contacts@edit_contact');
Route::post('/deletecontact', 'Contacts@delete_contact');



