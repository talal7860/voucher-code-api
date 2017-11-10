<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherCodesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('voucher_codes', function (Blueprint $table) {
      $table->increments('id');
      $table->string('code')->unique();
      $table->integer('recipient_id')->index();
      $table->integer('special_offer_id')->index();
      $table->datetime('redeemed_on')->nullable();
      $table->datetime('expiration_date');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('voucher_codes');
  }
}
