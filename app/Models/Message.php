<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Message extends Model
{
	use LogsActivity;
    //
    protected $fillable = ['admin_name', 'message_type', 'message_purpose', 'customer_name', 'customer_tel', 'message'];
}
