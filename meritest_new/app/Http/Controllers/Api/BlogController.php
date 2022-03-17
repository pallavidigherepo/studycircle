<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCategoryResource;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = BlogResource::collection(Blog::orderBy('created_at', 'DESC')->paginate(10));
        $blogsCategories = BlogCategory::all();

        $response = [
            'blogs' => $blogs,
            'blogCategories' => $blogsCategories,
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $blog = Blog::where('url', $url)->orWhere('slug', $url)->first();
        $blogsCategories = BlogCategory::all();

        $response = [
            'blog' => $blog,
            'blogCategories' => $blogsCategories,
        ];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
