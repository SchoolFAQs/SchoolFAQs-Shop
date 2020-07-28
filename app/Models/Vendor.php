<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Vendor extends Model
{
	use Searchable;
    use HasSlug;
    use LogsActivity;
    //

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('vendor_name')
            ->saveSlugsTo('slug');
    }
    
     public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $fillable = ['id', 'user_name', 'vendor_name', 'vendor_email', 'vendor_image', 'vendor_about', 'rate'];
    protected $table = 'vendors';
    public function products() {
    	return $this->hasMany(Product::class);
    }
    public function rates() {
        return $this->belongsToMany(Rate::class)->withTimestamps();
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
}
