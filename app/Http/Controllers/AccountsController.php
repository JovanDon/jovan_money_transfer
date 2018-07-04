<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accounts; 
use App\Transactions;
use Illuminate\Support\Facades\Validator;



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
    public function record_transaction(Request $request)
    {
     
        // define aray data to insert in User table
        $postData = [
            'amount' => $request->amount,
            'reciever_account'=> $request->account_reciever,
            'sender_account' => $request->account_sender
        ];
        $this->validator($postData);
        //insert  Contact data
        Transactions::create($postData);
        return (new ContactsController())->display_contacts_list();
    }

    public function get_json_accountData(Request $request)
    {
        $account_id = $request->account_id;

        $accountData = Accounts::where('id','=',$account_id)->get();
        return response($accountData);

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'amount' => 'required|numeric',
            'reciever_account' => 'required|numeric',
            'sender_account' => 'required|numeric',
        ]);
    }

}
