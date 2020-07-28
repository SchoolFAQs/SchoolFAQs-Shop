<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    //
    use Searchable;
    use HasSlug;
    use LogsActivity;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('product_name')
            ->saveSlugsTo('slug');
    }
    
     public function getRouteKeyName()
    {
        return 'slug';
    }

    public $asYouType = true;
    protected $fillable = ['product_name', 'slug', 'product_price', 'product_image', 'product_file', 'product_description', 'vendor_id', 'category_id'];
    protected $table = 'products';
    protected static $logAttributes = ['product_name', 'product_price', 'product_image', 'product_file', 'product_description', 'vendor_id', 'category_id'];
    public function vendor() {
    	return $this->belongsTo(Vendor::class);
    }
    public function categories() {
    	return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function orders() {
        return $this->hasMany(Order::class)->withTimestamps();
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
