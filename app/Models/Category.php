<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use Searchable;
    use HasSlug;
    use LogsActivity;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category_name')
            ->saveSlugsTo('slug');
    }
    
     public function getRouteKeyName()
    {
        return 'slug';
    }
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
