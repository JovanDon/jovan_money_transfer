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
        return $contacts;
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
