<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientsResource extends JsonResource
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
            'id' => (string)$this['id'],
            'name' => $this['name'],
            'email' => $this['email'],
            'phone' => $this['phone'],
            'mobilePhone' => $this['mobilePhone'],
            'cpfCnpj' => $this['cpfCnpj'],
            'postalCode' => $this['postalCode'],
            'address' => $this['address'],
            'addressNumber' => $this['addressNumber'],
            'complement' => $this['complement'],
            'province' => $this['province'],
            'notificationDisabled' => $this['notificationDisabled'],
            'additionalEmails' => $this['additionalEmails'],
            'municipalInscription' => $this['municipalInscription'],
            'stateInscription' => $this['stateInscription'],
            'observations' => $this['observations'],
        ];
    }
}
