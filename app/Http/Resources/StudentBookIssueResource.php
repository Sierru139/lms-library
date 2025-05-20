<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentBookIssueResource extends JsonResource
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
            'student_name' => $this->student_name,
            'apply_date' => $this->apply_date,
            'issue_date' => $this->issue_date,
            'returned_date' => $this->returned_date,
            'kelas' => $this->kelas,
            'jurusan' => $this->jurusan,
            'no_kartu_perp' => $this->no_kartu_perp,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
            'fine_received' => $this->fine_received,
            'id' => $this->id
        ];
    }
}
