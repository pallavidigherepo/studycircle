<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InquiryFollowupResource;
use App\Models\InquiryFollowup;
use App\Http\Requests\StoreInquiryFollowupRequest;
use App\Http\Requests\UpdateInquiryFollowupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class InquiryFollowupController extends Controller
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
        $inquiry = $request->input('inquiry_id') ?? null;

        return InquiryFollowupResource::collection(
            InquiryFollowup::when($request->input('search'), function ($query) {
                $query->where('inquiry_followup_type_id', 'like', '%' . request('search') . '%');
                $query->where('inquiry_id', '=', request('inquiry_id'));
            })->where('inquiry_id', $inquiry)->orderBy($field, $order)->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInquiryFollowupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInquiryFollowupRequest $request)
    {
        if ($request->validated()) {
            $input = $request->toArray();
            $input['created_by'] = Auth::user()->id;
            $input['updated_by'] = Auth::user()->id;
            $inquiryFollowup = InquiryFollowup::create($input);

            $response = [
                'success' => true,
                'message' => 'Inquiry follow up created successfully.',
                'inquiryFollowup' => $inquiryFollowup,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $request->validated(),
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InquiryFollowup  $inquiryFollowup
     * @return \Illuminate\Http\Response
     */
    public function show(InquiryFollowup $inquiryFollowup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInquiryFollowupRequest  $request
     * @param  \App\Models\InquiryFollowup  $inquiryFollowup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInquiryFollowupRequest $request, InquiryFollowup $inquiryFollowup)
    {
        if ($request->validated()) {
            $input = $request->toArray();
            $input['updated_by'] = Auth::user()->id;
            $inquiryFollowup->update($input);

            $response = [
                'success' => true,
                'message' => 'Inquiry followup updated successfully.',
                'inquiry' => $inquiryFollowup,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $request->validated()->errors(),
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InquiryFollowup  $inquiryFollowup
     * @return \Illuminate\Http\Response
     */
    public function destroy(InquiryFollowup $inquiryFollowup)
    {
        //
    }
}
