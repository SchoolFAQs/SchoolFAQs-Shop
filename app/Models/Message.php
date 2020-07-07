<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['admin_name', 'message_type', 'message_purpose', 'customer_name', 'customer_tel', 'message'];
}
