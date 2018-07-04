<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function display_createaccount_form(Request $request)
    {
        $logged_in_user=Auth::user();
        $user_id_ToCheck=$logged_in_user->id;
        if($request->user_id)
        $user_id_ToCheck=$request->user_id ;

        $contactinfo= User::all()->where('id', $user_id_ToCheck);
        
        return view('createaccount',compact('contactinfo',$contactinfo));
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
