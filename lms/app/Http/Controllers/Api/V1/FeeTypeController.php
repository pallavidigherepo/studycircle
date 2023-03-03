<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeeTypeResource;
use App\Models\FeeType;
use App\Http\Requests\StoreFeeTypeRequest;
use App\Http\Requests\UpdateFeeTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

/**
 * This class is FeeTypeController controller class with all fees management related functions and variables.
 *
 * @package Meritest_LMS_FeeType_Controller
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/fee_types
 */
class FeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return FeeTypeResource
     */
    public function index(Request $request):ResourceCollection
    {
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;
        return FeeTypeResource::collection(
            FeeType::when(request('search'), function ($query) {
                $query->where('name', 'like', '%'. request('search'). '%');
            })
            ->orderBy($field, $order)
            ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeeTypeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFeeTypeRequest $request)
    {
        if ($request->validated()) {
            $feeType = FeeType::create($request->toArray());

            $response = [
                'success' => true,
                'message' => 'Fee type created successfully.',
                'feeType' => $feeType,
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
     * @param  \App\Models\FeeType  $feeType
     * @return FeeTypeResource
     */
    public function show(FeeType $feeType)
    {
        return new FeeTypeResource(FeeType::FindOrFail($feeType->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeeTypeRequest  $request
     * @param  \App\Models\FeeType  $feeType
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateFeeTypeRequest $request, FeeType $feeType)
    {
        if ($request->validated()) {
            $feeType->name = $request->name;
            $feeType->updated_by = Auth::user()->id;

            $feeType->save();
            $response = [
                'success' => true,
                'message' => 'Fee Type updated successfully.',
                'feeType' => $feeType,
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
     * @param  \App\Models\FeeType  $feeType
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(FeeType $feeType)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($feeType->delete()) {
            $response = [
                'success' => true,
                'message' => 'Fee type deleted successfully.',
                'feeType' => $feeType,
            ];
        }
        return response()->json($response);
    }
}
