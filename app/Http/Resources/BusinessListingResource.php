<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'phone'=> $this->phone,
            'address'=> $this->address,
            'website_url'=> $this->website_url,
            'views'=> $this->views,
            'description'=> $this->description,
            'is_active'=> $this->is_active,
            'categoryIds'=> $this->categories->pluck('id'),
            'categories'=> $this->categories,
            'url'=> route('single.listing', ['listing'=> $this->id])
        ];
    
    }
}
