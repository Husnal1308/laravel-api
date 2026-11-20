<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {  
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'harga_format' => 'Rp '.number_format(
                $this->harga, 0, ',', '.'),
            'kategori' => $this->kategori,
            'sku' => $this->sku,
            'category' => $this->whenLoaded('category',
                fn () => $this->category?->only(['id', 'nama'])),
            'dibuat' => $this->created_at->format('d-m-Y'),
        ]; 
        //return parent::toArray($request);
    }
}
