<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $tags = array();
        if (!empty($this->tags)) {
            foreach ($this->tags as $tag) {
                $tags[] = $tag->name;
            }
        }
        return [
            'id' => $this->id,
            'question' => $this->question,
            'description' => $this->description,
            'board' => $this->board,
            'standard' => $this->standard,
            //'difficulty_level' => $this->difficulty_level,
            //'subject' => json_decode($this->subject->label),
            'board_id' => $this->board_id,
            'standard_id' => $this->standard_id,
            'difficulty_level_id' => $this->difficulty_level_id,
            'type_id' => $this->type_id,
            'language_id' => $this->language_id,
            'subject_id' => $this->subject_id,
            'chapter_id' => $this->chapter_id,
            'topic_id' => $this->topic_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'tags' => $tags,
            'answers' => $this->answers,
            'questions' => $this->questions,
        ];
    }
}
