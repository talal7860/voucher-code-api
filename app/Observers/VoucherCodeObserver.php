<?php

namespace App\Observers;

use App\VoucherCode;
use App\Lib\Coupon;

class VoucherCodeObserver
{
  /**
   * Listen to the Voucher creating event.
   *
   * @param  VoucherCode  $voucher_code
   * @return void
   */
  public function creating(VoucherCode $voucherCode)
  {
    // Increase iteration if a unique is not generated
    // Iteration will increase after every 10 iterations
    $loopIteration = 0;
    $couponCodes = VoucherCode::codes();
    $couponCode = "";
    do {
      $couponCode = Coupon::generate(8 + floor($loopIteration / 10));
      $loopIteration++;
    } while (array_search($couponCode, $couponCodes));
    $voucherCode->code = $couponCode;
    $voucherCode->redeemed_on = NULL;
  }

}
