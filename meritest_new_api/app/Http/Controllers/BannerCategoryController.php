<?php

namespace App\Http\Controllers;

use App\Models\BannerCategory;
use App\Http\Requests\StoreBannerCategoryRequest;
use App\Http\Requests\UpdateBannerCategoryRequest;

class BannerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BannerCategory $bannerCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerCategoryRequest $request, BannerCategory $bannerCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BannerCategory $bannerCategory)
    {
        //
    }
}
