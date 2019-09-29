<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractPerson extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'gender' => $this->gender,
            'policeNumber' => $this->police_number,
            'salesOrderId' => $this->sales_order_id,
            'documentIdPath' => $this->document_id_path,
            'birthday'      => $this->birthday,
            'products'  => $this->products()
        ];
    }
}
