<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuestBookVisitorResource extends JsonResource
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
            'alamat' => $this->alamat,
            'pekerjaan' => $this->pekerjaan,
            'maksud_kunjungan' => $this->maksud_kunjungan,
            'kesan' => $this->kesan,
            'pesan' => $this->pesan,
            'id' => $this->id
        ];
    }
}
