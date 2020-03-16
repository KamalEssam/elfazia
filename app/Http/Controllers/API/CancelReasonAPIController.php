<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCancelReasonAPIRequest;
use App\Http\Requests\API\UpdateCancelReasonAPIRequest;
use App\Models\CancelReason;
use App\Repositories\CancelReasonRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CancelReasonController
 * @package App\Http\Controllers\API
 */

class CancelReasonAPIController extends ApiController
{
    /** @var  CancelReasonRepository */
    private $cancelReasonRepository;

    public function __construct(CancelReasonRepository $cancelReasonRepo)
    {
        parent::__construct();
        $this->cancelReasonRepository = $cancelReasonRepo;
    }

    /**
     * Display a listing of the CancelReason.
     * GET|HEAD /cancelReasons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->cancelReasonRepository->all();
        $data['result'] = $this->cancelReasonRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created CancelReason in storage.
     * POST /cancelReasons
     *
     * @param CreateCancelReasonAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCancelReasonAPIRequest $request)
    {
        $input = $request->all();

        $cancelReasons = $this->cancelReasonRepository->create($input);
        $cancelReasons = $this->cancelReasonRepository->transform($cancelReasons);
        return $this->respondWithSuccess($cancelReasons);
    }

    /**
     * Display the specified CancelReason.
     * GET|HEAD /cancelReasons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var CancelReason $cancelReason */
        $cancelReason = $this->cancelReasonRepository->findWithoutFail($id);

        if (empty($cancelReason)) {
            return $this->respondWithError('Cancel Reason not found');
        }

        $cancelReason = $this->cancelReasonRepository->transform($cancelReason);

        return $this->respondWithSuccess($cancelReason);
    }

    /**
     * Update the specified CancelReason in storage.
     * PUT/PATCH /cancelReasons/{id}
     *
     * @param  int $id
     * @param UpdateCancelReasonAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCancelReasonAPIRequest $request)
    {
        $input = $request->all();

        /** @var CancelReason $cancelReason */
        $cancelReason = $this->cancelReasonRepository->findWithoutFail($id);

        if (empty($cancelReason)) {
            return $this->sendError('Cancel Reason not found');
        }

        $cancelReason = $this->cancelReasonRepository->update($input, $id);

        return $this->sendResponse($cancelReason->toArray(), 'CancelReason updated successfully');
    }

    /**
     * Remove the specified CancelReason from storage.
     * DELETE /cancelReasons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CancelReason $cancelReason */
        $cancelReason = $this->cancelReasonRepository->findWithoutFail($id);

        if (empty($cancelReason)) {
            return $this->respondWithError('Cancel Reason not found');
        }

        $cancelReason->delete();

        $data['message'] ="Cancel Reason deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
