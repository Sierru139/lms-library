<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentBookVisitorResource extends JsonResource
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
            'nama' => $this->nama ,
            'tujuan' => $this->tujuan,
            'kelas' => $this->kelas,
            'ket' => $this->ket,
            'id' => $this->id
        ];
    }
}
