<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\SpecialOffer;

class SpecialOfferTest extends TestCase
{

  use RefreshDatabase;
  /**
   * Testing valid object creation
   *
   * @return void
   */
  public function testValidCreate()
  {
    $specialOffer = factory(SpecialOffer::class)->make();
    $response = $this->json('POST', '/api/special-offers', $specialOffer->toArray());
    $response
      ->assertStatus(201)
      ->assertJson(['data' => [
        'name' => $specialOffer->name,
        'discount_percentage' => $specialOffer->discount_percentage()
      ]]);
  }

  /**
   * Testing object creation with incomplete params
   *
   * @return void
   */
  public function testInValidCreate()
  {
    $specialOffer = factory(SpecialOffer::class)->make();
    $response = $this->json('POST', '/api/special-offers', [
      'name' => $specialOffer->name
    ]);
    $response
      ->assertStatus(422);

    $response = $this->json('POST', '/api/special-offers', [
      'discount_percentage_cents' => $specialOffer->discount_percentage_cents
    ]);
    $response
      ->assertStatus(422);
  }

  /**
   * Testing valid object updating
   *
   * @return void
   */
  public function testValidUpdating()
  {
    $specialOffer = factory(SpecialOffer::class)->create();
    $response = $this->json('PUT', ("/api/special-offers/" . $specialOffer->id), [
      'name' => 'updated name',
      'discount_percentage_cents' => $specialOffer->discount_percentage_cents
    ]);
    $response
      ->assertStatus(200)
      ->assertJson(['data' => [
        'name' => 'updated name'
      ]]);
  }

  /**
   * Testing invalid object updating
   *
   * @return void
   */
  public function testInValidUpdating()
  {
    $specialOffer = factory(SpecialOffer::class)->create();
    $response = $this->json('PUT', ("/api/special-offers/" . $specialOffer->id), [
      'name' => 'updated name',
    ]);
    $response
      ->assertStatus(422);
  }

  /**
   * Testing delete
   *
   * @return void
   */
  public function testDelete()
  {
    $specialOffer = factory(SpecialOffer::class)->create();
    $response = $this->json('DELETE', ("/api/special-offers/" . $specialOffer->id));
    $response
      ->assertStatus(204);
    $this->assertDatabaseMissing('special_offers', [
      'id' => $specialOffer->id
    ]);
  }

}
