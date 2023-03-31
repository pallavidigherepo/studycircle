<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InquiryFollowupTypeResource;
use App\Models\InquiryFollowupType;
use App\Http\Requests\StoreInquiryFollowupTypeRequest;
use App\Http\Requests\UpdateInquiryFollowupTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InquiryFollowupTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;

        return InquiryFollowupTypeResource::collection(
            InquiryFollowupType::when($request->input('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })->orderBy($field, $order)->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInquiryFollowupTypeRequest $request
     * @return Response
     */
    public function store(StoreInquiryFollowupTypeRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
            ];
            $inquiryFollowupType = InquiryFollowupType::create($inputs);
            $response = [
                'success' => true,
                'message' => 'Inquiry Follow-up Type created successfully.',
                'inquiry_followup_type' => $inquiryFollowupType,
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
     * @param InquiryFollowupType $inquiryFollowupType
     * @return Response
     */
    public function show(InquiryFollowupType $inquiryFollowupType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInquiryFollowupTypeRequest $request
     * @param InquiryFollowupType $inquiryFollowupType
     * @return Response
     */
    public function update(UpdateInquiryFollowupTypeRequest $request, InquiryFollowupType $inquiryFollowupType)
    {
        if ($request->validated()) {
            $inquiryFollowupType->name = $request->name;

            $inquiryFollowupType->save();
            $response = [
                'success' => true,
                'message' => 'Inquiry Follow-up Type updated successfully.',
                'inquiry_followup_type' => $inquiryFollowupType,
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
     * @param InquiryFollowupType $inquiryFollowupType
     * @return Response
     */
    public function destroy(InquiryFollowupType $inquiryFollowupType)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($inquiryFollowupType->delete()) {
            $response = [
                'success' => true,
                'message' => 'Inquiry Follow-up Type deleted successfully.',
                'inquiry_followup_type' => $inquiryFollowupType,
            ];
        }
        return response()->json($response);
    }
}
