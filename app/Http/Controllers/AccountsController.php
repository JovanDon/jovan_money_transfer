<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Accounts; 
use App\Transactions;



class AccountsController extends Controller
{
   
    public function create_account(Request $request)
    {
        $logged_in_user=Auth::user();
        // define aray data to insert in User table
        $postData = [
            'account_name' => $request->account_name,
            'account_type'=> $request->account_type,
            'account_number' => $request->account_number,
            'user_id' => $request->owner_id!="loggedinUser"? $request->owner_id:$logged_in_user->id
        ];
       
        //insert  Contact data
        Accounts::create($postData);
        return (new ContactsController())->display_contacts_list();
    }
    public function create_account4send(Request $request)
    {
        $logged_in_user=Auth::user();
        // define aray data to insert in User table
        $postData = [
            'account_name' => $request->account_name,
            'account_type'=> $request->account_type, 
            'account_number' => $request->account_number,
            'user_id' => $request->owner_id!="loggedinUser"? $request->owner_id:$logged_in_user->id
        ];
        //insert  Contact data
        Accounts::create($postData);
        return (new HomeController())->display_sendmoney_form($request);
    }
    

    public function get_json_accountData(Request $request)
    {
        $account_id = $request->account_id;

        $accountData = Accounts::where('id','=',$account_id)->get();
        return response($accountData);

    }

    
}
