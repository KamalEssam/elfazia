<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCurriculumAPIRequest;
use App\Http\Requests\API\UpdateCurriculumAPIRequest;
use App\Models\Curriculum;
use App\Repositories\CurriculumRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CurriculumController
 * @package App\Http\Controllers\API
 */

class CurriculumAPIController extends ApiController
{
    /** @var  CurriculumRepository */
    private $curriculumRepository;

    public function __construct(CurriculumRepository $curriculumRepo)
    {
        parent::__construct();
        $this->curriculumRepository = $curriculumRepo;
    }

    /**
     * Display a listing of the Curriculum.
     * GET|HEAD /curricula
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->curriculumRepository->all();
        $data['result'] = $this->curriculumRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created Curriculum in storage.
     * POST /curricula
     *
     * @param CreateCurriculumAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCurriculumAPIRequest $request)
    {
        $input = $request->all();

        $curricula = $this->curriculumRepository->create($input);
        $curricula = $this->curriculumRepository->transform($curricula);
        return $this->respondWithSuccess($curricula);
    }

    /**
     * Display the specified Curriculum.
     * GET|HEAD /curricula/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var Curriculum $curriculum */
        $curriculum = $this->curriculumRepository->findWithoutFail($id);

        if (empty($curriculum)) {
            return $this->respondWithError('Curriculum not found');
        }

        $curriculum = $this->curriculumRepository->transform($curriculum);

        return $this->respondWithSuccess($curriculum);
    }

    /**
     * Update the specified Curriculum in storage.
     * PUT/PATCH /curricula/{id}
     *
     * @param  int $id
     * @param UpdateCurriculumAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCurriculumAPIRequest $request)
    {
        $input = $request->all();

        /** @var Curriculum $curriculum */
        $curriculum = $this->curriculumRepository->findWithoutFail($id);

        if (empty($curriculum)) {
            return $this->sendError('Curriculum not found');
        }

        $curriculum = $this->curriculumRepository->update($input, $id);

        return $this->sendResponse($curriculum->toArray(), 'Curriculum updated successfully');
    }

    /**
     * Remove the specified Curriculum from storage.
     * DELETE /curricula/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Curriculum $curriculum */
        $curriculum = $this->curriculumRepository->findWithoutFail($id);

        if (empty($curriculum)) {
            return $this->respondWithError('Curriculum not found');
        }

        $curriculum->delete();

        $data['message'] ="Curriculum deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
