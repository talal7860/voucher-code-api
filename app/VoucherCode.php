<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherCode extends Model
{
  protected $fillable = [
    'recipient_id',
    'special_offer_id',
    'expiration_date'
  ];

  public function recipient()
  {
    return $this->belongsTo('App\Recipient');
  }

  public function specialOffer()
  {
    return $this->belongsTo('App\SpecialOffer');
  }


  /**
   * Redeem a code received from params
   * @param @params
   * must have email and code
   * @return @voucherCode or an error array
   */

  public static function redeemVoucher($params) {
    $recipient = Recipient::where(['email' => $params['email']])->first();
    $error = '';
    if (!$recipient) {
      $error = 'Recipient not found';
    } else {
      $voucherCode = self::where([
        'recipient_id' => $recipient->id,
        'code' => $params['code']]
      )->first();
      if ($voucherCode) {
        if ($voucherCode->isRedeemed()) {
          $error = 'Voucher has already been redeemed';
        } else if ($voucherCode->hasExpired()) {
          $error = 'Voucher has expired';
        } else {
          $voucherCode->redeem();
          return $voucherCode;
        }
      } else {
        $error = 'Voucher not found';
      }
    }
    return ['error' => $error];
  }


  public function hasExpired() {
    return \Carbon\Carbon::now() > $this->expiration_date;
  }

  public function isRedeemed() {
    return !!$this->redeemed_on;
  }

  /**
   * Update the redeemed_on to now to mark the voucher as used
   * only when it has not been redeemed before
   * will return false otherwise
   * @return boolean
   */

  public function redeem()
  {
    if (!$this->isRedeemed() && !$this->hasExpired())
    {
      $this->redeemed_on = \Carbon\Carbon::now();
      return $this->save();
    }
    return false;
  }

  public static function codes()
  {
    return self::all()->pluck('code')->toArray();
  }

}
