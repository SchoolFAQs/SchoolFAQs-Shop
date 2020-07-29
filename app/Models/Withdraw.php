<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    //
    protected $fillable = ['id', 'user_id', 'user_number', 'user_email', 'withdraw_amount', 'withdraw_date', 'withdraw_status', 'balance'];
}
