<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeeTransactionResource;
use App\Models\FeeTransaction;
use App\Http\Requests\StoreFeeTransactionRequest;
use App\Http\Requests\UpdateFeeTransactionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeeTransactionController extends Controller
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
        $feeId = $request->input('fee_id') ?? null;

        return FeeTransactionResource::collection(
            FeeTransaction::when($request->input('search'), function ($query) {
                //$query->where('fee_id', '=', request('fee_id'));
            })->where('fee_id', $feeId)->orderBy($field, $order)->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeeTransactionRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFeeTransactionRequest $request): JsonResponse
    {
        if ($request->validated()) {
            $feeTransaction = FeeTransaction::create($request->toArray());

            $response = [
                'success' => true,
                'message' => 'Fee transaction done successfully.',
                'fee_transaction' => $feeTransaction,
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
     * @param  \App\Models\FeeTransaction  $feeTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(FeeTransaction $feeTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeeTransactionRequest  $request
     * @param  \App\Models\FeeTransaction  $feeTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeeTransactionRequest $request, FeeTransaction $feeTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeeTransaction  $feeTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeTransaction $feeTransaction)
    {
        //
    }
}
