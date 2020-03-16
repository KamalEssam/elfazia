<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeliveryCostAPIRequest;
use App\Http\Requests\API\UpdateDeliveryCostAPIRequest;
use App\Models\DeliveryCost;
use App\Repositories\DeliveryCostRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DeliveryCostController
 * @package App\Http\Controllers\API
 */

class DeliveryCostAPIController extends ApiController
{
    /** @var  DeliveryCostRepository */
    private $deliveryCostRepository;

    public function __construct(DeliveryCostRepository $deliveryCostRepo)
    {
        parent::__construct();
        $this->deliveryCostRepository = $deliveryCostRepo;
    }

    /**
     * Display a listing of the DeliveryCost.
     * GET|HEAD /deliveryCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->deliveryCostRepository->all();
        $data['result'] = $this->deliveryCostRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created DeliveryCost in storage.
     * POST /deliveryCosts
     *
     * @param CreateDeliveryCostAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliveryCostAPIRequest $request)
    {
        $input = $request->all();

        $deliveryCosts = $this->deliveryCostRepository->create($input);
        $deliveryCosts = $this->deliveryCostRepository->transform($deliveryCosts);
        return $this->respondWithSuccess($deliveryCosts);
    }

    /**
     * Display the specified DeliveryCost.
     * GET|HEAD /deliveryCosts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var DeliveryCost $deliveryCost */
        $deliveryCost = $this->deliveryCostRepository->findWithoutFail($id);

        if (empty($deliveryCost)) {
            return $this->respondWithError('Delivery Cost not found');
        }

        $deliveryCost = $this->deliveryCostRepository->transform($deliveryCost);

        return $this->respondWithSuccess($deliveryCost);
    }

    /**
     * Update the specified DeliveryCost in storage.
     * PUT/PATCH /deliveryCosts/{id}
     *
     * @param  int $id
     * @param UpdateDeliveryCostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliveryCostAPIRequest $request)
    {
        $input = $request->all();

        /** @var DeliveryCost $deliveryCost */
        $deliveryCost = $this->deliveryCostRepository->findWithoutFail($id);

        if (empty($deliveryCost)) {
            return $this->sendError('Delivery Cost not found');
        }

        $deliveryCost = $this->deliveryCostRepository->update($input, $id);

        return $this->sendResponse($deliveryCost->toArray(), 'DeliveryCost updated successfully');
    }

    /**
     * Remove the specified DeliveryCost from storage.
     * DELETE /deliveryCosts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DeliveryCost $deliveryCost */
        $deliveryCost = $this->deliveryCostRepository->findWithoutFail($id);

        if (empty($deliveryCost)) {
            return $this->respondWithError('Delivery Cost not found');
        }

        $deliveryCost->delete();

        $data['message'] ="Delivery Cost deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
