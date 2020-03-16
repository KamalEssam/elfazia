<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCityAPIRequest;
use App\Http\Requests\API\UpdateCityAPIRequest;
use App\Models\City;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CityController
 * @package App\Http\Controllers\API
 */

class CityAPIController extends ApiController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        parent::__construct();
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
     * GET|HEAD /cities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->cityRepository->all();
        $data['result'] = $this->cityRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created City in storage.
     * POST /cities
     *
     * @param CreateCityAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCityAPIRequest $request)
    {
        $input = $request->all();

        $cities = $this->cityRepository->create($input);
        $cities = $this->cityRepository->transform($cities);
        return $this->respondWithSuccess($cities);
    }

    /**
     * Display the specified City.
     * GET|HEAD /cities/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var City $city */
        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            return $this->respondWithError('City not found');
        }

        $city = $this->cityRepository->transform($city);

        return $this->respondWithSuccess($city);
    }

    /**
     * Update the specified City in storage.
     * PUT/PATCH /cities/{id}
     *
     * @param  int $id
     * @param UpdateCityAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityAPIRequest $request)
    {
        $input = $request->all();

        /** @var City $city */
        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            return $this->sendError('City not found');
        }

        $city = $this->cityRepository->update($input, $id);

        return $this->sendResponse($city->toArray(), 'City updated successfully');
    }

    /**
     * Remove the specified City from storage.
     * DELETE /cities/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var City $city */
        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            return $this->respondWithError('City not found');
        }

        $city->delete();

        $data['message'] ="City deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
