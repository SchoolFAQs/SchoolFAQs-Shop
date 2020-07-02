<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['product_name', 'product_price', 'product_image', 'product_file', 'product_description', 'vendor_id', 'category_id'];
    protected $table = 'products';
    public function vendor() {
    	return $this->belongsTo(Vendor::class);
    }
    public function categories() {
    	return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
