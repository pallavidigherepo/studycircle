<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ChapterRequest;
use App\Http\Resources\TopicResource;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Get all list
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;

        $topics = TopicResource::collection(
            Topic::when(request('search'), function ($query) {
                $query->where('parent_id', '!=', null);
                $query->where('label', 'like', '%' . request('search') . '%');
                $query->orWhere('icon', 'like', '%' . request('search') . '%');
            })
                ->where('parent_id', '!=', null)
                ->with('chapter')
                ->orderBy($field, $order)
                ->paginate($perPage)
        );
        return $topics;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list() {
        //echo "aasdasd";
        //$chapters =  $this->belongsTo(Subject::class)->with('chapter');
        $chapters = Topic::with('chapters')->get()->pluck('id', 'label');
        dd($chapters);
    }
}
