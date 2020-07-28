<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    //
    protected $fillable = ['id', 'user_id', 'user_tel', 'transact_id', 'transaction_id', 'disburse_status', 'balance'];
}
