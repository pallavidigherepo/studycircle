<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'board' => [
                'required',
            ],
            'standard' => [
                'required',
            ],
            'explaination' => [
                'required',
            ],
            'difficulty_level' => [
                'required',
            ],
            'type_id' => [
                'required',
            ],
            'language_id' => [
                'required',
            ],
            'subject_id' => [
                'required',
            ],
            'chapter_id' => [
                'required',
            ],
            'topic_id' => [
                'required',
            ],
        ];
    }
}
