<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherBookIssueResource extends JsonResource
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
            'book' => new BookResource($this->whenLoaded('book')),
            'teacher' => new StudentResource($this->whenLoaded('teacher')),
            'teacher_name' => $this->teacher_name,
            'apply_date' => $this->apply_date,
            'issue_date' => $this->issue_date,
            'return_date' => $this->return_date,
            'status' => $this->status,
            'returned_date' => $this->returned_date,
            'fine_received' => $this->fine_received,
            'id' => $this->id
        ];
    }
}
