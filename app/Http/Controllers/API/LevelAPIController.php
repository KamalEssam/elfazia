<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLevelAPIRequest;
use App\Http\Requests\API\UpdateLevelAPIRequest;
use App\Models\Level;
use App\Repositories\LevelRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LevelController
 * @package App\Http\Controllers\API
 */

class LevelAPIController extends ApiController
{
    /** @var  LevelRepository */
    private $levelRepository;

    public function __construct(LevelRepository $levelRepo)
    {
        parent::__construct();
        $this->levelRepository = $levelRepo;
    }

    /**
     * Display a listing of the Level.
     * GET|HEAD /levels
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->levelRepository->all();
        $data['result'] = $this->levelRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created Level in storage.
     * POST /levels
     *
     * @param CreateLevelAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLevelAPIRequest $request)
    {
        $input = $request->all();

        $levels = $this->levelRepository->create($input);
        $levels = $this->levelRepository->transform($levels);
        return $this->respondWithSuccess($levels);
    }

    /**
     * Display the specified Level.
     * GET|HEAD /levels/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var Level $level */
        $level = $this->levelRepository->findWithoutFail($id);

        if (empty($level)) {
            return $this->respondWithError('Level not found');
        }

        $level = $this->levelRepository->transform($level);

        return $this->respondWithSuccess($level);
    }

    /**
     * Update the specified Level in storage.
     * PUT/PATCH /levels/{id}
     *
     * @param  int $id
     * @param UpdateLevelAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLevelAPIRequest $request)
    {
        $input = $request->all();

        /** @var Level $level */
        $level = $this->levelRepository->findWithoutFail($id);

        if (empty($level)) {
            return $this->sendError('Level not found');
        }

        $level = $this->levelRepository->update($input, $id);

        return $this->sendResponse($level->toArray(), 'Level updated successfully');
    }

    /**
     * Remove the specified Level from storage.
     * DELETE /levels/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Level $level */
        $level = $this->levelRepository->findWithoutFail($id);

        if (empty($level)) {
            return $this->respondWithError('Level not found');
        }

        $level->delete();

        $data['message'] ="Level deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
