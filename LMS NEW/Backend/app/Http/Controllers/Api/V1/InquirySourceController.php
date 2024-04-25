<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InquirySourceResource;
use App\Models\InquirySource;
use App\Http\Requests\StoreInquirySourceRequest;
use App\Http\Requests\UpdateInquirySourceRequest;
use Illuminate\Http\Request;

class InquirySourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;

        return InquirySourceResource::collection(
            InquirySource::when($request->input('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })->orderBy($field, $order)->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInquirySourceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInquirySourceRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
            ];
            $inquirySource = InquirySource::create($inputs);
            $response = [
                'success' => true,
                'message' => 'Inquiry Source created successfully.',
                'inquiry_source' => $inquirySource,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InquirySource  $inquirySource
     * @return \Illuminate\Http\Response
     */
    public function show(InquirySource $inquirySource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInquirySourceRequest  $request
     * @param  \App\Models\InquirySource  $inquirySource
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInquirySourceRequest $request, InquirySource $inquirySource)
    {
        if ($request->validated()) {
            $inquirySource->name = $request->name;

            $inquirySource->save();
            $response = [
                'success' => true,
                'message' => 'Inquiry Follow-up Type updated successfully.',
                'inquiry_source' => $inquirySource,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InquirySource  $inquirySource
     * @return \Illuminate\Http\Response
     */
    public function destroy(InquirySource $inquirySource)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($inquirySource->delete()) {
            $response = [
                'success' => true,
                'message' => 'Batch deleted successfully.',
                'inquiry_source' => $inquirySource,
            ];
        }
        return response()->json($response);
    }
}
