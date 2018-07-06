<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use App\Accounts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function display_myTransactions()
    {

        $logged_in_user=Auth::user();

        $transactions= $this->getUserTransactiondata($logged_in_user);

        return view('transactions',compact('transactions',$transactions));

    }
    public function getUserTransactiondata($logged_in_user){
       return DB::table('users')
        ->join('accounts as accountssender', 'users.id', '=', 'accountssender.user_id')
        ->join('transactions', 'accountssender.id', '=', 'transactions.sender_account')
        ->join('accounts as accountsReceiver', 'accountsReceiver.id', '=', 'transactions.reciever_account')
        ->join('users as receiverContact', 'receiverContact.id', '=', 'accountsReceiver.user_id')
        ->select('users.fname',
         'users.lname',
         'receiverContact.fname as fname_receiver', 
         'receiverContact.lname as lname_receiver',
         'accountssender.account_number',
          'accountsReceiver.account_number as account_number_receiver', 
          'transactions.amount', 'transactions.created_at as transactiontime')
        ->where('users.id' ,$logged_in_user->id)
        ->orderByRaw('transactiontime DESC')
        ->get();
    }
    public function record_transaction(Request $request)
    {
        dd($request);
     
        // define aray data to insert in User table
        $postData = [
            'amount' => $request->amount,
            'reciever_account'=> $request->account_reciever,
            'sender_account' => $request->account_sender
        ];
        $this->validator($postData);
        //insert  Contact data
        Transactions::create($postData);
        return $this->display_myTransactions();
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
