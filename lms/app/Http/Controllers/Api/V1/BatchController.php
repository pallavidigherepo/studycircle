<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BatchRequest;
use App\Models\Batch;
use App\Http\Resources\BatchResource;
use Illuminate\Http\Request;

class BatchController extends Controller
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

        return BatchResource::collection(
            Batch::when($request->input('search'), function ($query) {
                $query->where('label', 'like', '%' . request('search') . '%');
                $query->orWhere('description', 'like', '%' . request('search') . '%');
                $query->orWhere('icon', 'like', '%' . request('search') . '%');
            })->orderBy($field, $order)->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BatchRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
                'is_active'=> $request->is_active ?: !$request->is_active,
            ];
            $batch = Batch::create($inputs);
            $response = [
                'success' => true,
                'message' => 'Batch created successfully.',
                'batch' => $batch,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BatchRequest $request, Batch $batch)
    {
        if ($request->validated()) {
            $batch->name = $request->name;
            $batch->is_active = $request->is_active ?: !$request->is_active;

            $batch->save();
            $response = [
                'success' => true,
                'message' => 'Batch updated successfully.',
                'batch' => $batch,
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
     * @param  Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($batch->delete()) {
            $response = [
                'success' => true,
                'message' => 'Batch deleted successfully.',
                'batch' => $batch,
            ];
        }
        return response()->json($response);
    }
}
