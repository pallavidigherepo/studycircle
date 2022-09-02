<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateRequest;
use App\Http\Resources\TemplateResourse;
use App\Models\QuestionType;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
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

        return TemplateResourse::collection(
            Template::when(request('search'), function ($query) {
                $query->where('name', 'like', '%'. request('search'). '%');
            })
                ->orderBy($field, $order)
                ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        $response = [
            'success' => false,
            'message' => 'Oops, something went wrong.'
        ];
        if ($request->validated()) {
            $inputData = [
                'board_id' => $request->board_id,
                'standard_id' => $request->standard_id,
                'name' => $request->name,
                'description' => $request->description,
                'total_marks' => $request->total_marks,
                'duration' => $request->duration,
                'has_section' => $request->has_section,
                'is_active' => $request->is_active,
                'total_questions' => $request->total_questions,
                'compulsory_questions' => $request->compulsory_questions,
                'type_id' => $request->type_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'sections' => $request->has_section ? json_encode($request->sections) : null,
            ];

            if (Template::create($inputData)) {
                $response = [
                    'success' => true,
                    'message' => 'Successfully added'
                ];
            }
        }

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        return new TemplateResourse(Template::findOrFail($template->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TemplateRequest $request
     * @param Template $template
     * @return Response
     */
    public function update(TemplateRequest $request, Template $template)
    {
        if ($request->validated()) {
            $inputData = [
                'board_id' => $request->board_id,
                'standard_id' => $request->standard_id,
                'name' => $request->name,
                'total_marks' => $request->total_marks,
                'duration' => $request->duration,
                'has_section' => $request->has_section,
                'is_active' => $request->is_active,
                'total_questions' => $request->total_questions,
                'compulsory_questions' => $request->compulsory_questions,
                'type_id' => $request->type_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'sections' => $request->has_section ? json_encode($request->sections) : null,
            ];

            $template->update($inputData);

            $response = [
                'success' => true,
                'message' => 'Subject is updated successfully.',
                'template' => $template,
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
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];

        if ($template->delete()) {
            $response = [
                'success' => true,
                'message' => 'Template deleted successfully.',
            ];
        }
        return response()->json($response);
    }
}
