<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\FeeTransaction;
use App\Http\Requests\StoreFeeTransactionRequest;
use App\Http\Requests\UpdateFeeTransactionRequest;

class FeeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeeTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeeTransactionRequest $request)
    {
        //
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
