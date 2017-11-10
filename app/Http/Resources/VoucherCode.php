<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\RecipientCollection;
use App\Http\Resources\SpecialOfferCollection;

class VoucherCode extends Resource
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
        'special_offer' => $this->specialOffer,
        'code' => $this->code,
        'redeemed_on' => $this->redeemed_on,
        'recipient' => $this->recipient,
        'expiration_date' => (string) $this->expiration_date,
        'created_at' => (string) $this->created_at,
        'updated_at' => (string) $this->updated_at
      ];
    }
}
