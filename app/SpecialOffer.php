<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
  protected $fillable = ['name', 'discount_percentage_cents'];


  public function discount_percentage() {
    return floatval($this->discount_percentage_cents) / 100;
  }

  public function voucherCodes()
  {
    return $this->hasMany('App\VoucherCode');
  }
}
