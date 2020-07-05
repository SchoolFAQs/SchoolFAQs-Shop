<?php

namespace App\Models;
use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use Searchable;
    public $asYouType = true;
    protected $fillable = ['product_name', 'product_price', 'product_image', 'product_file', 'product_description', 'vendor_id', 'category_id'];
    protected $table = 'products';
    public function vendor() {
    	return $this->belongsTo(Vendor::class);
    }
    public function categories() {
    	return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function orders() {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
}
