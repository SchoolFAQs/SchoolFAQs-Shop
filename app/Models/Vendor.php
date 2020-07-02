<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
    protected $fillable = ['id', 'user_name', 'vendor_name', 'vendor_email', 'vendor_image', 'vendor_about'];
    protected $table = 'vendors';
    public function products() {
    	return $this->hasMany(Product::class);
    }
}
