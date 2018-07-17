<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use App\Accounts;
use App\User;


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
        ->select('users.fname',  'users.lname',   'receiverContact.fname as fname_receiver',    'receiverContact.lname as lname_receiver',   'accountssender.account_name',  'accountssender.account_number', 'accountsReceiver.account_name as account_name_receiver', 'accountsReceiver.account_number as account_number_receiver', 
          'transactions.amount', 'transactions.created_at as transactiontime')
        ->where('users.id' ,$logged_in_user->id)
        ->orderByRaw('transactiontime DESC')
        ->get();
    }
    public function record_transaction(Request $request)
    {        
       $postData = $this->generateTransactionData($request);  
      
        $this->validator($postData);
        Transactions::create($postData);

        return $this->display_myTransactions();
    }

    protected function  generateTransactionData(Request $request){
        if(($request->Sender_action=="" || $request->receiver_action=="")){

            return $this->getTransactionDataFor_old_user($request);
    
        }else{
            $receiverAcct=$this->insertReceiversData($request);
            $senderAcct=$this->insertSendersData($request);
            
            return [
                'amount' => $request->amount,  'reciever_account'=> $receiverAcct, 'sender_account' => $senderAcct
                ];
        }   

    }
   
    protected function  getTransactionDataFor_old_user(Request $request){
        return [
        'amount' => $request->amount,
        'reciever_account'=> $request->account_reciever,
        'sender_account' => $request->account_sender
        ];
    }
    public function insertSendersData(Request $request){
        
        if($request->Sender_action=="sender_mm"){
            
           $createdAccout= Accounts::create($this->generateSenderAccount_mm_Data($request));
            
            return $createdAccout->id;

           }else if($request->Sender_action=="sender_bank"){

            $createdAccout= Accounts::create($this->generateSenderAccount_bank_Data($request));

            return $createdAccout->id;
           }
    }
    protected function generateSenderAccount_mm_Data(Request $request){
        $logged_in_user=Auth::user(); 
        return [
            'account_name' => $request->registeredNames,
            'account_type'=> 'mobile_money',
            'account_number' => $request->account_number,
            'user_id' => $logged_in_user->id,
            'bank_name'=>null
        ];
    }
    protected function generateSenderAccount_bank_Data(Request $request){
        $logged_in_user=Auth::user(); 
        return [
            'account_name' => $request->account_name,
            'account_type'=> 'bank_account',
            'account_number' => $request->account_number,
            'user_id' => $logged_in_user->id,
            'bank_name'=>$request->bank_name
        ];
    }
    public function insertReceiversData(Request $request){
        if($request->receiver_action=="receiver_mm"){
                $insertedContact=$this->insertContact_info($request->registeredNames_receiver,$request->account_number_receiver);
                $accountcreated=Accounts::create([
                    'account_name' => $request->registeredNames_receiver,
                    'account_type'=> 'mobile_money',
                    'account_number' => $request->account_number_receiver,
                    'user_id' => $insertedContact,
                    'bank_name'=>null
                ]);
                return $accountcreated->id;
           }else if($request->receiver_action=="receiver_bank"){
                $insertedContact=$this->insertContact_info($request->account_name_receiver,$request->account_number_receiver);
            
                $accountcreated=Accounts::create([
                    'account_name' => $request->account_name_receiver,
                    'account_type'=> 'bank_account',
                    'account_number' => $request->account_number_receiver,
                    'user_id' =>$insertedContact ,
                    'bank_name'=>$request->bank_name_receiver
                ]);
                return $accountcreated->id;
           }    

    }
    
    public function insertContact_info($name,$phone){
        $logged_in_user=Auth::user();

       $savedModelinstance= User::create([
            'fname' => $name,
            'lname'=> ' ',
            'email' => null,
            'phonenumber' =>$phone ,
            'country'=>' ',
            'password'=>null,
            'created_by'=>$logged_in_user->id
        ]);
        return $savedModelinstance->id;
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
