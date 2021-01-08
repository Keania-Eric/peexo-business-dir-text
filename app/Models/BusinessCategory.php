<?php

namespace App\Models;

use App\Models\BusinessListing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function getRouteKeyName()
    {
        return 'id';
    }
    
    
    /**
     * Listings with this category
     *
     * @return void
     */
    public function listings()
    {
        return $this->belongsToMany(BusinessListing::class, 'business_listing_category_pivots');
    }
}
