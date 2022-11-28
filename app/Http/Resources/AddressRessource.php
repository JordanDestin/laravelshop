<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressRessource extends JsonResource
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
            'address' => $this->address,
            'addressbis' => $this->addressbis,
            'postal' => $this->postal,
            'city' => $this->city,
            'delivery' => $this->delivery,
            'billing' => $this->billing,
            'user_id' => $this->user_id,
        ];
    }
}
