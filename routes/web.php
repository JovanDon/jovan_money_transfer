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
use App\User;
use App\Accounts;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
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
Route::get('/ajaxcall', 'ContactsController@fetchcontact_data');


Route::get('/getcontact_info',function(Request $request)
{
    $contact_id = $request->contact_id;
    $contactData = User::where('id','=',$contact_id)->get();
    return Response::json($contactData);

});
Route::get('/getaccounts_info',function(Request $request)
{
    $contact_id = $request->contact_id;
    $contactData = Accounts::where('user_id','=',$contact_id)->get();
    return Response::json($contactData);

});
Route::get('/getaccount_info',function(Request $request)
{
    $contact_id = $request->contact_id;
    $contactData = Accounts::where('id','=',$contact_id)->get();
    return Response::json($contactData);

});



