<?php

namespace App\Models;

use App\Models\BusinessListingImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessListing extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * images of this listing
     *
     * @return void
     */
    public function images()
    {
        return $this->hasMany(BusinessListingImage::class);
    }

    
    /**
     * Retrieves the default image of a listing
     *
     * @return void
     */
    public function getDefaultImageAttribute()
    {
        return $this->images->where('is_default', true);
    }

    
    /**
     * All categories a listing belong to
     *
     * @return void
     */
    public function categories()
    {
        return $this->belongsToMany(BusinessCategory::class, 'business_listing_category_pivots', 'listing_id', 'category_id');
    }
}
