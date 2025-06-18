<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'no_induk' => $this->no_induk,
            'tanggal_buat' => $this->tanggal_buat,
            'no_judul' => $this->no_judul,
            'penerbit' => $this->penerbit,
            'cet_ed' => $this->cet_ed,
            'jilid' => $this->jilid,
            'tahun_terbit' => $this->tahun_terbit,
            'kota_terbit' => $this->kota_terbit,
            'buy_from' => $this->buy_from,
            'present_from' => $this->present_from,
            'no_of_copy' => $this->no_of_copy,
            'harga' => $this->harga,
            'jumlah' => $this->jumlah,
            'no_class' => $this->no_class,
            'keterangan' => $this->keterangan,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'author' => new AuthorResource($this->whenLoaded('author')),
            'location' => new LocationRackResource($this->whenLoaded('location')),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
