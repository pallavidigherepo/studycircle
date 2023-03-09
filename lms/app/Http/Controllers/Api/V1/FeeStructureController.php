<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeeStructureResource;
use App\Models\FeeStructure;
use App\Http\Requests\StoreFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

/**
 * This class is FeeStructureController controller class with all fees management related functions and variables.
 *
 * @package Meritest_LMS_FeeStructure_Controller
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/fee_structures
 */
class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request):ResourceCollection
    {
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;
        return FeeStructureResource::collection(
            FeeStructure::when(request('search'), function ($query) {
                $query->where('standard_id', 'like', '%'. request('search'). '%');
            })
            ->orderBy($field, $order)
            ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeeStructureRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFeeStructureRequest $request)
    {
        if ($request->validated()) {
            $feeStructure = FeeStructure::create($request->toArray());

            $response = [
                'success' => true,
                'message' => 'Fee structure created successfully.',
                'fee_structure' => new FeeStructureResource(FeeStructure::find($feeStructure->id)),
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
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return FeeStructureResource
     */
    public function show(FeeStructure $feeStructure)
    {
        return new FeeStructureResource(FeeStructure::FindOrFail($feeStructure->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeeStructureRequest  $request
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateFeeStructureRequest $request, FeeStructure $feeStructure)
    {
        if ($request->validated()) {

            $feeStructure->standard_id = $request->standard_id;
            $feeStructure->batch_id = $request->batch_id;
            $feeStructure->fee_category_id = $request->fee_category_id;
            $feeStructure->amount = $request->amount;
            $feeStructure->updated_by = Auth::user()->id;

            $feeStructure->save();
            $response = [
                'success' => true,
                'message' => 'Fee structure updated successfully.',
                'fee_structure' => new FeeStructureResource(FeeStructure::find($feeStructure->id)),
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
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(FeeStructure $feeStructure)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($feeStructure->delete()) {
            $response = [
                'success' => true,
                'message' => 'Fee structure deleted successfully.',
                'fee_structure' => $feeStructure,
            ];
        }
        return response()->json($response);
    }
}
