<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\SpecialOffer;
use App\VoucherCode;

class SpecialOfferTest extends TestCase
{
  use RefreshDatabase;
  /**
   * testing create
   *
   * @return void
   */
  public function testCreate()
  {
    $specialOffer = factory(SpecialOffer::class)->create();
    $this->assertDatabaseHas('special_offers', [
      'name' => $specialOffer->name
    ]);
  }

  /**
   * testing update
   *
   * @return void
   */
  public function testUpdate()
  {
    $specialOffer = factory(SpecialOffer::class)->create();
    $specialOffer->name =  'Updated name';
    $specialOffer->save();
    $this->assertDatabaseHas('special_offers', [
      'name' => 'Updated name'
    ]);
  }

  /**
   * testing delete
   *
   * @return void
   */
  public function testDelete()
  {
    $specialOffer = factory(SpecialOffer::class)->create();
    $name = $specialOffer->name;
    $specialOffer->delete();
    $this->assertDatabaseMissing('special_offers', [
      'name' => $name
    ]);
  }

  /**
   * testing relationship with voucher codes
   *
   * @return void
   */
  public function testHasManyVoucherCodes()
  {
    $voucherCode = factory(VoucherCode::class)->create();
    $specialOffer = $voucherCode->specialOffer;
    $exists = $specialOffer->voucherCodes->contains($voucherCode->id);
    $this->assertTrue($exists);
  }
}
