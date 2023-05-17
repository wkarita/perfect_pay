<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CepsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable\JsonSerializable
     */
    public function toArray($request)
    {

        // dd($this);
        return [
            'address' => $this['address'],
            'cityId' => $this['cityId'],
            'cityName' => $this['cityName'],
            'isGeneral' => $this['isGeneral'],
            'postalCode' => $this['postalCode'],
            'province' => $this['province'],
            'state' => $this['state'],
        ];
    }
}
