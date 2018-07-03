<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function display_contacts_table()
    {
        return view('contactlist');
    }
    public function display_createaccount_form()
    {
        return view('createaccount');
    }
    public function display_createcontact_form()
    {
       
        $app = app();
        $contact = $app->make('stdClass');
        $contact->id = 0;
        return view('createcontact',compact('contact',$contact));
    }
    public function display_sendmoney_form()
    {
        return view('sendmoney');
    }
    
    
}
