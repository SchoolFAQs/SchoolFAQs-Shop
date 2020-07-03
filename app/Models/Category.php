<?php

namespace App\Models;
use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use Searchable;
    //
    protected $fillable = ['id', 'category_name', 'category_description', 'cover_photo'];
    protected $table = 'categories';
    public function products() {
    	return $this->belongsToMany(Product::class)->withTimestamps();
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
}
