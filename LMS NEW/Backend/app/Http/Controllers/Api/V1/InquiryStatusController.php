<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InquiryStatusResource;
use App\Models\InquiryStatus;
use App\Http\Requests\StoreInquiryStatusRequest;
use App\Http\Requests\UpdateInquiryStatusRequest;
use Illuminate\Http\Request;

class InquiryStatusController extends Controller
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

        return InquiryStatusResource::collection(
            InquiryStatus::when($request->input('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })->orderBy($field, $order)->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInquiryStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInquiryStatusRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
            ];
            $inquiryStatus = InquiryStatus::create($inputs);
            $response = [
                'success' => true,
                'message' => 'Inquiry Status created successfully.',
                'inquiry_status' => $inquiryStatus,
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
     * @param  \App\Models\InquiryStatus  $inquiryStatus
     * @return \Illuminate\Http\Response
     */
    public function show(InquiryStatus $inquiryStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInquiryStatusRequest  $request
     * @param  \App\Models\InquiryStatus  $inquiryStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInquiryStatusRequest $request, InquiryStatus $inquiryStatus)
    {
        if ($request->validated()) {
            $inquiryStatus->name = $request->name;

            $inquiryStatus->save();
            $response = [
                'success' => true,
                'message' => 'Inquiry Follow-up Type updated successfully.',
                'inquiry_status' => $inquiryStatus,
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
     * @param  \App\Models\InquiryStatus  $inquiryStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(InquiryStatus $inquiryStatus)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($inquiryStatus->delete()) {
            $response = [
                'success' => true,
                'message' => 'Batch deleted successfully.',
                'inquiry_status' => $inquiryStatus,
            ];
        }
        return response()->json($response);
    }
}
