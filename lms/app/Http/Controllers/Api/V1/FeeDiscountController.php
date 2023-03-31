<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeeDiscountResource;
use App\Models\FeeDiscount;
use App\Http\Requests\StoreFeeDiscountRequest;
use App\Http\Requests\UpdateFeeDiscountRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * This class is FeeDiscountController controller class with all fees management related functions and variables.
 *
 * @package Meritest_LMS_FeeDiscount_Controller
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/fee_discounts
 */
class FeeDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ResourceCollection
     */
    public function index(Request $request):ResourceCollection
    {
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;
        return FeeDiscountResource::collection(
            FeeDiscount::when(request('search'), function ($query) {
                $query->where('name', 'like', '%'. request('search'). '%');
            })
            ->orderBy($field, $order)
            ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeDiscountRequest $request)
    {
        if ($request->validated()) {
            $feeDiscount = FeeDiscount::create($request->toArray());

            $response = [
                'success' => true,
                'message' => 'Fee discount created successfully.',
                'fee_discount' => $feeDiscount,
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
     */
    public function show(FeeDiscount $feeDiscount)
    {
        return new FeeDiscountResource(FeeDiscount::FindOrFail($feeDiscount->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeeDiscountRequest $request, FeeDiscount $feeDiscount)
    {
        if ($request->validated()) {
            $feeDiscount->name = $request->name;
            $feeDiscount->amount = $request->amount;

            $feeDiscount->save();
            $response = [
                'success' => true,
                'message' => 'Fee discount updated successfully.',
                'fee_discount' => $feeDiscount,
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
     */
    public function destroy(FeeDiscount $feeDiscount)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($feeDiscount->delete()) {
            $response = [
                'success' => true,
                'message' => 'Fee discount deleted successfully.',
                'fee_discount' => $feeDiscount,
            ];
        }
        return response()->json($response);
    }
}
