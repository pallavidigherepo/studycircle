<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InquiryResource;
use App\Models\Inquiry;
use App\Http\Requests\StoreInquiryRequest;
use App\Http\Requests\UpdateInquiryRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InquiryController extends Controller
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

        return InquiryResource::collection(
            Inquiry::when($request->input('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
                $query->orWhere('guard_name', 'like', '%' . request('search') . '%');
            })->orderBy($field, $order)->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInquiryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInquiryRequest $request)
    {
        if ($request->validated()) {
            $input = $request->toArray();
            $input['unique_code'] = generate_unique_code_inquiry();
            $input['created_by'] = Auth::user()->id;
            $input['updated_by'] = Auth::user()->id;
            $input['inquiry_date'] = Carbon::today();
            $inquiry = Inquiry::create($input);

            $response = [
                'success' => true,
                'message' => 'Inquiry created successfully.',
                'inquiry' => $inquiry,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry)
    {
        $inquiryModel = new Inquiry();
        // We need manipulated data of student so that he/she cannot do any kind of cheating.
        //return $studentModel->manipulateStudentInfo(new StudentResource(Student::findOrFail($student->id)));
        return new InquiryResource(Inquiry::findOrFail($inquiry->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInquiryRequest  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInquiryRequest $request, Inquiry $inquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry)
    {
        //
    }
}
