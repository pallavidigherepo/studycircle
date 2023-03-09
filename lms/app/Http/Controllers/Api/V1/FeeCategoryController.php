<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeeCategoryResource;
use App\Models\FeeCategory;
use App\Http\Requests\StoreFeeCategoryRequest;
use App\Http\Requests\UpdateFeeCategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

/**
 * This class is FeeCategoryController controller class with all fees management related functions and variables.
 *
 * @package Meritest_LMS_FeeCategory_Controller
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/fee_categories
 */
class FeeCategoryController extends Controller
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
        return FeeCategoryResource::collection(
            FeeCategory::when(request('search'), function ($query) {
                $query->where('name', 'like', '%'. request('search'). '%');
            })
            ->orderBy($field, $order)
            ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeeCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(StoreFeeCategoryRequest $request):JsonResponse
    {
        if ($request->validated()) {
            $feeCategory = FeeCategory::create($request->toArray());

            $response = [
                'success' => true,
                'message' => 'Fee category created successfully.',
                'fee_category' => $feeCategory,
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
     * @param  \App\Models\FeeCategory  $feeCategory
     * @return FeeCategoryResource
     */
    public function show(FeeCategory $feeCategory)
    {
        return new FeeCategoryResource(FeeCategory::FindOrFail($feeCategory->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeeCategoryRequest  $request
     * @param  \App\Models\FeeCategory  $feeCategory
     * @return JsonResponse
     */
    public function update(UpdateFeeCategoryRequest $request, FeeCategory $feeCategory)
    {
        if ($request->validated()) {
            $feeCategory->name = $request->name;

            $feeCategory->save();
            $response = [
                'success' => true,
                'message' => 'Fee category updated successfully.',
                'fee_category' => $feeCategory,
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
     * @param  \App\Models\FeeCategory  $feeCategory
     * @return JsonResponse
     */
    public function destroy(FeeCategory $feeCategory)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($feeCategory->delete()) {
            $response = [
                'success' => true,
                'message' => 'Fee category deleted successfully.',
                'fee_category' => $feeCategory,
            ];
        }
        return response()->json($response);
    }
}
