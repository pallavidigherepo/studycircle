<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StandardRequest;
use App\Http\Resources\StandardResource;
use App\Models\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
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

        return StandardResource::collection(
            Standard::when($request->input('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })->orderBy($field, $order)->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StandardRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
            ];
            $standard = Standard::create($inputs);
            $standard->sections()->sync($request->standard_section_ids);

            $standard->standard_section_ids = $request->standard_section_ids;

            $sectionNames = array();
            if (!empty($standard->sections)) {
                foreach ($standard->sections as $section) {
                    $sectionNames[] = $section->name;
                }
            }

            $standard->standard_section_names = $sectionNames;
            $response = [
                'success' => true,
                'message' => 'Standard created successfully.',
                'standard' => $standard,
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
    public function update(StandardRequest $request, Standard $standard)
    {
        if ($request->validated()) {
            $standard->name = $request->name;

            $standard->save();
            $standard->sections()->sync($request->standard_section_ids);

            $standard->standard_section_ids = $request->standard_section_ids;

            $sectionNames = array();
            if (!empty($standard->sections)) {
                foreach ($standard->sections as $section) {
                    $sectionNames[] = $section->name;
                }
            }

            $standard->standard_section_names = $sectionNames; //$request->standard_section_ids;
            $response = [
                'success' => true,
                'message' => 'Standard updated successfully.',
                'standard' => $standard,
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
     * @param  object  $standard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Standard $standard)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($standard->delete()) {
            $response = [
                'success' => true,
                'message' => 'Standard deleted successfully.',
                'standard' => $standard,
            ];
        }
        return response()->json($response);
    }
}
