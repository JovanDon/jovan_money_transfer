<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'amount', 'reciever_account',  'sender_account',
    ];

    public $timestamps = false;
}
