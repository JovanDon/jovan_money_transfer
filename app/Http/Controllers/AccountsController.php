<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accounts;



class AccountsController extends Controller
{
    public function create_account(Request $request)
    {
        // define aray data to insert in User table
        $postData = [
            'account_name' => $request->account_name,
            'account_type'=> $request->account_type,
            'account_number' => $request->account_number,
            'user_id' => $request->owner_id
        ];
       
        //insert  Contact data
        Accounts::create($postData);
        return (new ContactsController())->display_contacts_list();
    }
 
}
