<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionBankGroupAPIRequest;
use App\Http\Requests\API\UpdateQuestionBankGroupAPIRequest;
use App\Models\QuestionBankGroup;
use App\Repositories\QuestionBankGroupRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuestionBankGroupController
 * @package App\Http\Controllers\API
 */

class QuestionBankGroupAPIController extends ApiController
{
    /** @var  QuestionBankGroupRepository */
    private $questionBankGroupRepository;

    public function __construct(QuestionBankGroupRepository $questionBankGroupRepo)
    {
        parent::__construct();
        $this->questionBankGroupRepository = $questionBankGroupRepo;
    }

    /**
     * Display a listing of the QuestionBankGroup.
     * GET|HEAD /questionBankGroups
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->questionBankGroupRepository->all();
        $data['result'] = $this->questionBankGroupRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created QuestionBankGroup in storage.
     * POST /questionBankGroups
     *
     * @param CreateQuestionBankGroupAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionBankGroupAPIRequest $request)
    {
        $input = $request->all();

        $questionBankGroups = $this->questionBankGroupRepository->create($input);
        $questionBankGroups = $this->questionBankGroupRepository->transform($questionBankGroups);
        return $this->respondWithSuccess($questionBankGroups);
    }

    /**
     * Display the specified QuestionBankGroup.
     * GET|HEAD /questionBankGroups/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var QuestionBankGroup $questionBankGroup */
        $questionBankGroup = $this->questionBankGroupRepository->findWithoutFail($id);

        if (empty($questionBankGroup)) {
            return $this->respondWithError('Question Bank Group not found');
        }

        $questionBankGroup = $this->questionBankGroupRepository->transform($questionBankGroup);

        return $this->respondWithSuccess($questionBankGroup);
    }

    /**
     * Update the specified QuestionBankGroup in storage.
     * PUT/PATCH /questionBankGroups/{id}
     *
     * @param  int $id
     * @param UpdateQuestionBankGroupAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionBankGroupAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionBankGroup $questionBankGroup */
        $questionBankGroup = $this->questionBankGroupRepository->findWithoutFail($id);

        if (empty($questionBankGroup)) {
            return $this->sendError('Question Bank Group not found');
        }

        $questionBankGroup = $this->questionBankGroupRepository->update($input, $id);

        return $this->sendResponse($questionBankGroup->toArray(), 'QuestionBankGroup updated successfully');
    }

    /**
     * Remove the specified QuestionBankGroup from storage.
     * DELETE /questionBankGroups/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionBankGroup $questionBankGroup */
        $questionBankGroup = $this->questionBankGroupRepository->findWithoutFail($id);

        if (empty($questionBankGroup)) {
            return $this->respondWithError('Question Bank Group not found');
        }

        $questionBankGroup->delete();

        $data['message'] ="Question Bank Group deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
