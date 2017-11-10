<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Recipient;

class RecipientTest extends TestCase
{

  use RefreshDatabase;
  /**
   * Testing valid object creation
   *
   * @return void
   */
  public function testValidCreate()
  {
    $recipient = factory(Recipient::class)->make();
    $response = $this->json('POST', '/api/recipients', $recipient->toArray());
    $response
      ->assertStatus(201)
      ->assertJson(['data' => [
        'name' => $recipient->name,
        'email' => $recipient->email
      ]]);
  }

  /**
   * Testing object creation with incomplete params
   *
   * @return void
   */
  public function testInValidCreate()
  {
    $recipient = factory(Recipient::class)->make();
    $response = $this->json('POST', '/api/recipients', [
      'name' => $recipient->name
    ]);
    $response
      ->assertStatus(422);

    $response = $this->json('POST', '/api/recipients', [
      'email' => $recipient->email
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
    $recipient = factory(Recipient::class)->create();
    $response = $this->json('PUT', ("/api/recipients/" . $recipient->id), [
      'name' => 'updated name',
      'email' => $recipient->email
    ]);
    $response
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
    $recipient = factory(Recipient::class)->create();
    $response = $this->json('PUT', ("/api/recipients/" . $recipient->id), [
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
    $recipient = factory(Recipient::class)->create();
    $response = $this->json('DELETE', ("/api/recipients/" . $recipient->id));
    $response
      ->assertStatus(204);
    $this->assertDatabaseMissing('recipients', [
      'id' => $recipient->id
    ]);
  }

}
