<?php

namespace App\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BusinessListing;
use App\Models\BusinessCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\BusinessListingResource;

class FrontController extends Controller
{
    //
    public function welcome(Request $request)
    {
        
        $listings = BusinessListingResource::collection(BusinessListing::active()->get());
        return Inertia::render('Welcome', ['listings'=> $listings]);
    
       
    }

    
    /**
     * search for listings
     *
     * @param  mixed $request
     * @return void
     */
    public function search(Request $request)
    {
        $searchText = $request->text;
        $businessListings = BusinessListing::active()->where('name', 'like', '%'.$searchText.'%')
                            ->orWhere('description', 'like', '%'.$searchText.'%')->get();
        $listings = BusinessListingResource::collection($businessListings);
        return Inertia::render('Welcome', ['listings'=> $listings]);

    }
    

    /**
     * API Search 
     *
     * @param  mixed $request
     * @return void
     */
    public function apiSearch(Request $request)
    {
        try {
            $searchText = $request->text;
            $businessListings = BusinessListing::active()->where('name', 'like', '%'.$searchText.'%')
                                ->orWhere('description', 'like', '%'.$searchText.'%')->get();
            $listings = BusinessListingResource::collection($businessListings);
            
            return response()->json($listings);
        }catch (\Exception $e) {

            return response()->json(['error'=> 'An unknown error occurred'], 422);
        }catch (Throwable $e) {
            return response()->json(['error'=> 'An unknown error occurred'], 422);
        }
        

    }


    
    /**
     * view single listing
     *
     * @param  mixed $request
     * @return void
     */
    public function viewListing(BusinessListing $listing)
    {
        $listing->update(['views'=> $listing->views + 1]);
        return Inertia::render('SingleListing', ['listing'=> $listing]);

    }
}
