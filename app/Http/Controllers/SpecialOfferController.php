<?php

namespace App\Http\Controllers;
use App\SpecialOffer;
use App\Http\Resources\SpecialOffer as SpecialOfferResource;
use App\Http\Requests\StoreSpecialOffer;

use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{

  /**
   * List all Special Offers
   * @return SpecialOfferResourceCollection
   */

  public function index()
  {
    return SpecialOfferResource::Collection(SpecialOffer::paginate());
  }

  /**
   * Show the special offer.
   *
   * @param  SpecialOffer $specialOffer
   * @return SpecialOfferResource
   */
  public function show(SpecialOffer $specialOffer)
  {
    return new SpecialOfferResource($specialOffer);
  }

  /**
   * Save the special offer
   * @param StoreSpecialOffer $request
   * @return SpecialOfferResource
   */

  public function store(StoreSpecialOffer $request)
  {
    $specialOffer = SpecialOffer::create($request->all());

    return new SpecialOfferResource($specialOffer, 201);
  }

  /**
   * Update a given special offer
   * @param StoreSpecialOffer $request
   * @param SpecialOffer $specialOffer
   * @return SpecialOfferResource
   */

  public function update(StoreSpecialOffer $request, SpecialOffer $specialOffer)
  {
    $specialOffer->update($request->all());
    return new SpecialOfferResource($specialOffer, 200);
  }


  /**
   * Delete a special offer
   * @param SpecialOffer $specialOffer
   * @return Response
   */

  public function delete(SpecialOffer $specialOffer)
  {
    $specialOffer->delete();

    return response()->json(null, 204);
  }
}
