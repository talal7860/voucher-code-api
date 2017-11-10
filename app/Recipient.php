<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
  protected $fillable = ['name', 'email'];

  public function voucherCodes()
  {
    return $this->hasMany('App\VoucherCode');
  }
}
