<?php

namespace App\Http\Controllers;
use App\User;
use App\Accounts;
use Illuminate\Support\Facades\DB;
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
    public function display_sendmoney_form(Request $request)
    {
        
        $reciever_id=$request->contact_id;
       
        $reciever_accounts=DB::table('users')
        ->Leftjoin('accounts', 'users.id', '=', 'accounts.user_id')
        ->select('users.fname', 'users.lname','users.id as contact_id' ,'accounts.*')
        ->where('users.id', $reciever_id)
        ->get();

        if($this->do_loggedIn_user_has_accounts()==false){
            $reciever_accounts=null;
           
            return view('sendmoney',compact('reciever_accounts',$reciever_accounts));

        }elseif($reciever_id==null){
            $logged_in_user=Auth::user();
            $recievers=DB::table('users')
            ->select('users.fname', 'users.lname','users.id as contact_id' )
            ->where('users.created_by', $logged_in_user->id)
            ->get();
            
            return view('sendmoney2',compact('recievers',$recievers));
    
        }
        
        return view('sendmoney',compact('reciever_accounts',$reciever_accounts));
    }

    public function do_loggedIn_user_has_accounts(){
        $users_accts=$this->getLoggedin_UserAccounts();
        $Receivers=(new ContactsController())->getContactList();
      if( $users_accts->isEmpty() && $Receivers->isEmpty()){
        return false;
      }
        return true;
    }
    

    public function getLoggedin_UserAccounts(){
        $logged_in_user=Auth::user();

        $sender_accounts= Accounts::all()->where('user_id', $logged_in_user->id);
       
        return $sender_accounts;
    }
    
}
