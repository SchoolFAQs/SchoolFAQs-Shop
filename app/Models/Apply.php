<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    //
    protected $fillable = [
        'name', 'email','date_of_birth', 'tel', 'id_card_f', 'id_card_b', 'license', 'kyc_form',
    ];
}
