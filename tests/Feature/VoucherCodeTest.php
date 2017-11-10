<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\VoucherCode;

class VoucherCodeTest extends TestCase
{

  use RefreshDatabase;
  /**
   * Testing valid object creation
   *
   * @return void
   */
  public function testValidCreate()
  {
    $voucherCode = factory(VoucherCode::class)->make();
    $response = $this->json('POST', '/api/voucher-codes', $voucherCode->toArray());
    $response
      ->assertStatus(201);
  }

  /**
   * Testing object creation with incomplete params
   *
   * @return void
   */
  public function testInValidCreate()
  {
    $voucherCode = factory(VoucherCode::class)->make();
    $response = $this->json('POST', '/api/voucher-codes', [
      'expiration_date' =>'asdfasdf'
    ]);
    $response
      ->assertStatus(422);

    $response = $this->json('POST', '/api/voucher-codes', [
      'recipient_id' => 120099
    ]);
    $response
      ->assertStatus(422);
  }


  /**
   * Testing invalid object updating
   *
   * @return void
   */
  public function testInValidUpdating()
  {
    $voucherCode = factory(VoucherCode::class)->create();
    $response = $this->json('PUT', ("/api/voucher-codes/" . $voucherCode->id), [
    ]);
    $response
      ->assertStatus(500);
  }


  /**
   * Test Redeeming
   *
   * @return void
   */
  public function testRedeem()
  {
    $voucherCode = factory(VoucherCode::class)->create();
    $response = $this->json('POST', ("/api/voucher-codes/redeem"), [
      'code' => $voucherCode->code,
      'email' => $voucherCode->recipient->email
    ]);
    $response
      ->assertStatus(200);
  }

  /**
   * Test Redeeming
   *
   * @return void
   */
  public function testWithInvalidCode()
  {
    $voucherCode = factory(VoucherCode::class)->create();
    $response = $this->json('POST', ("/api/voucher-codes/redeem"), [
      'code' => 'asdfasdf',
      'email' => $voucherCode->recipient->email
    ]);
    $response
      ->assertStatus(422);
  }
  /**
   * Test Redeeming
   *
   * @return void
   */
  public function testWithInvalidRecipient()
  {
    $voucherCode = factory(VoucherCode::class)->create();
    $response = $this->json('POST', ("/api/voucher-codes/redeem"), [
      'code' => $voucherCode->code,
      'email' => 'asdfasdf@gmail.com'
    ]);
    $response
      ->assertStatus(422);
  }

  /**
   * Test Redeeming
   *
   * @return void
   */
  public function testWithExpiredCoupon()
  {
    $voucherCode = factory(VoucherCode::class)->create();
    $voucherCode->expiration_date = date('d.m.Y',strtotime("-1 days"));
    $voucherCode->save();
    $response = $this->json('POST', ("/api/voucher-codes/redeem"), [
      'code' => $voucherCode->code,
      'email' => $voucherCode->recipient->email
    ]);
    $response
      ->assertStatus(422);
  }

}
