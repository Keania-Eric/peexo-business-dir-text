<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BusinessListing;
use App\Models\BusinessCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BusinessListingResource;

class BusinessListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BusinessCategory::all();
        $listings = BusinessListingResource::collection(BusinessListing::all());
        return Inertia::render('Admin/BusinessListing', ['categories'=> $categories, 'listings'=>$listings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|unique:business_listings',
            'email' => 'required|email|unique:business_listings',
            'website_url' => 'required|string|unique:business_listings',
            'phone' => 'required|unique:business_listings',
            'address' => 'required',
            'description'=> 'required',
            'categories' => 'required'
        ])->validate();

        try {
            DB::beginTransaction();
               
                $data = $request->only(['name', 'email', 'website_url', 'phone', 'address', 'description']);
                $listing = BusinessListing::create($data); 
               
                if($listing) {

                    $listing->categories()->attach($request->categories);
                }
                
            DB::commit();
            return redirect()->back()->with('message', 'New listing successfully added');
        }catch(\Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with('failure', 'An unknown error occurred');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessListing $listing)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|unique:business_listings,name,'.$listing->id,
            'email' => 'required|email|unique:business_listings,email,'.$listing->id,
            'website_url' => 'required|string|unique:business_listings,website_url,'.$listing->id,
            'phone' => 'required|unique:business_listings,phone,'.$listing->id,
            'address' => 'required',
            'description'=> 'required',
            'categoryIds' => 'required'
        ])->validate();

        try {
            DB::beginTransaction();

                if($listing->update($request->only(['name', 'email', 'website_url', 'phone', 'address', 'description', 'is_active']))) {

                    $listing->categories()->sync($request->categoryIds);
                }
            DB::commit();  
            return redirect()->back()->with('message', 'New listing successfully updated');
        }catch(\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('failure', 'An unknown error occurred');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessListing $listing)
    {
       
        try {
            DB::beginTransaction();

                if($listing->categories()->sync([])) {

                    $listing->delete();
                }
                DB::commit();
                
                return redirect()->back()->with('message', 'Listing sucessfully deleted');

           
        }catch(\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('failure', 'An unknown error occurred');
        }
    }
}
