<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Accounts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
   
    public function create_contact(Request $request)
    {

        $logged_in_user=Auth::user();
        // define aray data to insert in User table
        $postData = [
            'fname' => $request->fname,
            'lname'=> $request->lname,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'country' => $request->country,
            'created_by' => $logged_in_user->id
        ];
        //insert  Contact data
        User::create($postData);
        return $this->display_contacts_list();
    }

    public function display_contacts_list()
    {
        $contacts=$this->getContactList(); 
        
   
        return view('contactlist',compact('contacts',$contacts));

    }
    
    public function getContactList()
    {
        $logged_in_user=Auth::user();
        
        $contacts= User::all()->where('created_by',$logged_in_user->id );

        foreach($contacts as $contact){
            $last_transaction=$this->getReceiver_last_transaction($contact->id);

            if($last_transaction->first()!=null){
                $date_of_last_transact = $last_transaction->first()->Created_at;  

                $contact->last_transaction=$date_of_last_transact;
            }
                       
        }
        
        return $contacts;
    }
    private function getReceiver_last_transaction($Userid){

        $user_transactions= DB::table('users')
        ->join('accounts', 'accounts.user_id', '=', 'users.id')        
        ->join('transactions', 'transactions.reciever_account', '=', 'accounts.id') 
        ->where('users.id',$Userid)       
        ->select('transactions.*')
        ->orderBy('transactions.id', 'desc')
        ->get();

        return $user_transactions;
    }
    public function edit_contact(Request $request)
    {
        
        $contact= User::where('id',$request->contact_id )->first();
        
        return view('createcontact',compact('contact',$contact));

    }   
    public function update_contact(Request $request)
    {
        $logged_in_user=Auth::user();

        // define aray data to insert in User table
        $postData = [
            'fname' => $request->fname,
            'lname'=> $request->lname,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'country' => $request->country,
            'created_by' => $logged_in_user->id
        ];
        
        //insert  Contact data
        User::where('id', $request->_id)->update($postData);
        return redirect()->route('contactlist');

    }  
    public function delete_contact(Request $request)
    {
      
        User::where('id', $request->contact_id)->delete();
        return redirect()->route('contactlist');

    } 
 
   

}
