<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillingsResource extends JsonResource
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
            'id' => $this['id'],
            'customer' => $this['customer'],
            'billingType' => $this['billingType'],
            'status' => $this['status'],
            'invoiceUrl' => $this['invoiceUrl'],
            'bankSlipUrl' => $this['bankSlipUrl'],
            'nossoNumero' => $this['nossoNumero'],
        ];
    }
}
