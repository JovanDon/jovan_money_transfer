<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use App\Accounts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    public function display_myTransactions()
    {

        $logged_in_user=Auth::user();

        $accounts=DB::table('users')
        ->join('accounts', 'accounts.user_id', '=', 'users.id')
        ->join('transactions', 'accounts.user_id', '=', 'transactions.sender_account')
        ->select('transactions.*', 'accounts.account_number', 'users.fname','users.lname')
        ->where('users.id', $logged_in_user->id )
        ->get();
   dd($accounts);
        return view('contactlist',compact('contacts',$contacts));

    }
}
