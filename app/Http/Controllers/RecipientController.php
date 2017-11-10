<?php

namespace App\Http\Controllers;
use App\Recipient;
use App\Http\Resources\Recipient as RecipientResource;
use App\Http\Requests\StoreRecipient;

use Illuminate\Http\Request;

class RecipientController extends Controller
{

  /**
   * List all Recipients
   * @return RecipientResourceCollection
   */
  public function index()
  {
    return RecipientResource::Collection(Recipient::paginate());
  }

  /**
   * Show the special offer.
   *
   * @param  Recipient $recipient
   * @return RecipientResource
   */
  public function show(Recipient $recipient)
  {
    return new RecipientResource($recipient);
  }

  /**
   * Save the special offer
   * @param StoreRecipient $request
   * @return RecipientResource
   */

  public function store(StoreRecipient $request)
  {
    $recipient = Recipient::create($request->all());

    return new RecipientResource($recipient, 201);
  }

  /**
   * Update a given special offer
   * @param StoreRecipient $request
   * @param Recipient $recipient
   * @return RecipientResource
   */

  public function update(StoreRecipient $request, Recipient $recipient)
  {
    $recipient->update($request->all());
    return new RecipientResource($recipient, 200);
  }


  /**
   * Delete a special offer
   * @param Recipient $recipient
   * @return Response
   */

  public function delete(Recipient $recipient)
  {
    $recipient->delete();

    return response()->json(null, 204);
  }
}
