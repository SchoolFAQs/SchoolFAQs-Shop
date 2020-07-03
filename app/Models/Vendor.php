<?php

namespace App\Models;
use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
	use Searchable;
    //
    protected $fillable = ['id', 'user_name', 'vendor_name', 'vendor_email', 'vendor_image', 'vendor_about'];
    protected $table = 'vendors';
    public function products() {
    	return $this->hasMany(Product::class);
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
}
