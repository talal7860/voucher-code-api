<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Recipient;
use App\VoucherCode;

class RecipientTest extends TestCase
{
  use RefreshDatabase;

  /**
   * testing create
   *
   * @return void
   */
  public function testCreate()
  {
    $recipient = factory(Recipient::class)->create();
    $this->assertDatabaseHas('recipients', [
      'email' => $recipient->email
    ]);
  }

  /**
   * testing update
   *
   * @return void
   */
  public function testUpdate()
  {
    $recipient = factory(Recipient::class)->create();
    $recipient->name =  'Updated name';
    $recipient->save();
    $this->assertDatabaseHas('recipients', [
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
    $recipient = factory(Recipient::class)->create();
    $name = $recipient->name;
    $recipient->delete();
    $this->assertDatabaseMissing('recipients', [
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
    $recipient = $voucherCode->recipient;
    $exists = $recipient->voucherCodes->contains($voucherCode->id);
    $this->assertTrue($exists);
  }
}
