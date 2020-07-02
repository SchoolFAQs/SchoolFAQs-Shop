<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['customer_name', 'customer_tel', 'product_name', 'product_price', 'product_id'];
}
