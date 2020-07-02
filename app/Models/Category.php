<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['id', 'category_name', 'category_description', 'cover_photo'];
    protected $table = 'categories';
    public function products() {
    	return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
