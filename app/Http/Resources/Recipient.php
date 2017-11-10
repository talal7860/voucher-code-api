<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\VoucherCodeCollection;

class Recipient extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
      return [
        'id' => $this->id,
        'name' => $this->name,
        'email' => $this->email,
        'created_at' => (string) $this->created_at,
        'updated_at' => (string) $this->updated_at,
        'voucher_codes' => VoucherCodeCollection::collection($this->voucherCodes)
      ];
    }
}
