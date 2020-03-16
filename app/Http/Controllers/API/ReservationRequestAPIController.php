<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReservationRequestAPIRequest;
use App\Http\Requests\API\UpdateReservationRequestAPIRequest;
use App\Models\ReservationRequest;
use App\Repositories\ReservationRequestRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ReservationRequestController
 * @package App\Http\Controllers\API
 */

class ReservationRequestAPIController extends ApiController
{
    /** @var  ReservationRequestRepository */
    private $reservationRequestRepository;

    public function __construct(ReservationRequestRepository $reservationRequestRepo)
    {
        parent::__construct();
        $this->reservationRequestRepository = $reservationRequestRepo;
    }

    /**
     * Display a listing of the ReservationRequest.
     * GET|HEAD /reservationRequests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->reservationRequestRepository->all();
        $data['result'] = $this->reservationRequestRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created ReservationRequest in storage.
     * POST /reservationRequests
     *
     * @param CreateReservationRequestAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReservationRequestAPIRequest $request)
    {
        $input = $request->all();

        $reservationRequests = $this->reservationRequestRepository->create($input);
        $reservationRequests = $this->reservationRequestRepository->transform($reservationRequests);
        return $this->respondWithSuccess($reservationRequests);
    }

    /**
     * Display the specified ReservationRequest.
     * GET|HEAD /reservationRequests/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var ReservationRequest $reservationRequest */
        $reservationRequest = $this->reservationRequestRepository->findWithoutFail($id);

        if (empty($reservationRequest)) {
            return $this->respondWithError('Reservation Request not found');
        }

        $reservationRequest = $this->reservationRequestRepository->transform($reservationRequest);

        return $this->respondWithSuccess($reservationRequest);
    }

    /**
     * Update the specified ReservationRequest in storage.
     * PUT/PATCH /reservationRequests/{id}
     *
     * @param  int $id
     * @param UpdateReservationRequestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservationRequestAPIRequest $request)
    {
        $input = $request->all();

        /** @var ReservationRequest $reservationRequest */
        $reservationRequest = $this->reservationRequestRepository->findWithoutFail($id);

        if (empty($reservationRequest)) {
            return $this->sendError('Reservation Request not found');
        }

        $reservationRequest = $this->reservationRequestRepository->update($input, $id);

        return $this->sendResponse($reservationRequest->toArray(), 'ReservationRequest updated successfully');
    }

    /**
     * Remove the specified ReservationRequest from storage.
     * DELETE /reservationRequests/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ReservationRequest $reservationRequest */
        $reservationRequest = $this->reservationRequestRepository->findWithoutFail($id);

        if (empty($reservationRequest)) {
            return $this->respondWithError('Reservation Request not found');
        }

        $reservationRequest->delete();

        $data['message'] ="Reservation Request deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
