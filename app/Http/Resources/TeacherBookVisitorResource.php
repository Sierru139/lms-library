<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherBookVisitorResource extends JsonResource
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
            'tanggal' => $this->tanggal,
            'nama' => $this->nama,
            'tujuan' => $this->tujuan,
            'ket' => $this->tujuan,
            'id' => $this->id
        ];
    }
}
