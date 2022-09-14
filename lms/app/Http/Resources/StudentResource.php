<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'aadhaar' => $this->aadhaar,
            'board_id' => $this->board_id,
            'board' => $this->board->name ?? $this->board_id,
            'standard_id' => $this->standard_id,
            'standard' => $this->standard->name ?? $this->standard_id,
            'batch_id' => $this->batch_id,
            'batch' => $this->batch->name ?? $this->batch_id,
            'course_id' => $this->course_id,
            'mobile' => $this->mobile,
            'alt_mobile' => $this->alt_mobile,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'permanent_address' => $this->permanent_address,
            'address' => $this->address,
            'mother_name' => $this->mother_name,
            'mother_email' => $this->mother_email,
            'mother_mobile' => $this->mother_mobile,
            'mother_qualification' => $this->mother_qualification,
            'mother_occupation' => $this->mother_occupation,
            'father_name' => $this->father_name,
            'father_email' => $this->father_email,
            'father_mobile' => $this->father_mobile,
            'father_qualification' => $this->father_qualification,
            'father_occupation' => $this->father_occupation,
            'avatar' => $this->avatar ? URL::to($this->avatar) : null,
        ];
    }
}
