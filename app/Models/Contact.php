<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    //
    protected $fillable = ['ticket_id', 'user_name', 'user_tel', 'message','admin_name', 'is_solved', 'solve_date'];
}
