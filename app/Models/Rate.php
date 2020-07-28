<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Rate extends Model
{
	use HasSlug;
    use LogsActivity;
    //
     protected $fillable = ['rate_name', 'rate_type', 'slug', 'rate_value', 'expiry_date', 'admin_name'];

     public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('rate_name')
            ->saveSlugsTo('slug');
    }
     public function products() {
    	return $this->belongsToMany(Product::class)->withTimestamps();
    }
    public function vendors() {
    	return $this->belongsToMany(Vendor::class)->withTimestamps();
    }
    protected static $logAttributes = ['rate_name', 'rate_type', 'rate_value', 'admin_name'];
}
