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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@display_sendmoney_form')->name('sendmoney');
Route::get('/contactlist', 'ContactsController@display_contacts_list')->name('contactlist');
Route::get('/createcontact', 'HomeController@display_createcontact_form')->name('createcontact');
Route::get('/createaccount', 'HomeController@display_createaccount_form')->name('createaccount');
Route::post('/sendmoney', 'HomeController@display_sendmoney_form');
Route::post('/addcontact', 'ContactsController@create_contact');
Route::post('/updatecontact', 'ContactsController@update_contact');
Route::post('/editcontact', 'ContactsController@edit_contact');
Route::post('/deletecontact', 'ContactsController@delete_contact');
Route::post('/addaccount_action', 'AccountsController@create_account');
Route::post('/addaccount', 'HomeController@display_createaccount_form');
Route::post('/sendmoney_action', 'TransactionsController@record_transaction');
Route::get('/viewmytransactions', 'TransactionsController@display_myTransactions');



Route::get('/getaccount_info','AccountsController@get_json_accountData');



