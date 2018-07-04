<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $fillable = [
        'account_name', 'account_type',  'account_number','user_id',
    ];
}
