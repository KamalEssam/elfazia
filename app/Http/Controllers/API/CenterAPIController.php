<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCenterAPIRequest;
use App\Http\Requests\API\UpdateCenterAPIRequest;
use App\Models\Center;
use App\Repositories\CenterRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CenterController
 * @package App\Http\Controllers\API
 */

class CenterAPIController extends ApiController
{
    /** @var  CenterRepository */
    private $centerRepository;

    public function __construct(CenterRepository $centerRepo)
    {
        parent::__construct();
        $this->centerRepository = $centerRepo;
    }

    /**
     * Display a listing of the Center.
     * GET|HEAD /centers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->centerRepository->all();
        $data['result'] = $this->centerRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created Center in storage.
     * POST /centers
     *
     * @param CreateCenterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCenterAPIRequest $request)
    {
        $input = $request->all();

        $centers = $this->centerRepository->create($input);
        $centers = $this->centerRepository->transform($centers);
        return $this->respondWithSuccess($centers);
    }

    /**
     * Display the specified Center.
     * GET|HEAD /centers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var Center $center */
        $center = $this->centerRepository->findWithoutFail($id);

        if (empty($center)) {
            return $this->respondWithError('Center not found');
        }

        $center = $this->centerRepository->transform($center);

        return $this->respondWithSuccess($center);
    }

    /**
     * Update the specified Center in storage.
     * PUT/PATCH /centers/{id}
     *
     * @param  int $id
     * @param UpdateCenterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCenterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Center $center */
        $center = $this->centerRepository->findWithoutFail($id);

        if (empty($center)) {
            return $this->sendError('Center not found');
        }

        $center = $this->centerRepository->update($input, $id);

        return $this->sendResponse($center->toArray(), 'Center updated successfully');
    }

    /**
     * Remove the specified Center from storage.
     * DELETE /centers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Center $center */
        $center = $this->centerRepository->findWithoutFail($id);

        if (empty($center)) {
            return $this->respondWithError('Center not found');
        }

        $center->delete();

        $data['message'] ="Center deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
