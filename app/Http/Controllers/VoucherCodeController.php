<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VoucherCode;
use App\Http\Resources\VoucherCode as VoucherCodeResource;
use App\Http\Requests\StoreVoucherCode;
use App\Http\Requests\RedeemVoucherCode;


class VoucherCodeController extends Controller
{
  /**
   * List all VoucherCodes
   * @return VoucherCodeResourceCollection
   */
  public function index()
  {
    return VoucherCodeResource::Collection(VoucherCode::paginate());
  }

  /**
   * Show the voucher code.
   *
   * @param  VoucherCode $voucherCode
   * @return VoucherCodeResource
   */
  public function show(VoucherCode $voucherCode)
  {
    return new VoucherCodeResource($voucherCode);
  }

  /**
   * generate the voucher code for a special offer and recipient
   * @param StoreVoucherCode $request
   * @return VoucherCodeResource
   */

  public function store(StoreVoucherCode $request)
  {
    $voucherCode = VoucherCode::create($request->all());

    return new VoucherCodeResource($voucherCode, 201);
  }

  /**
   * Save the special offer
   * @param StoreVoucherCode $request
   * @return VoucherCodeResource
   */

  public function redeem(RedeemVoucherCode $request)
  {
    $result = VoucherCode::redeemVoucher($request->all());
    if (!$result['error']) {
      return response()->json(['message' => 'redeemed'], 200);
    } else {
      return response()->json($result, 422);
    }
  }
}
