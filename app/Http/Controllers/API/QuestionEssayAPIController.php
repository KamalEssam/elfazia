<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionEssayAPIRequest;
use App\Http\Requests\API\UpdateQuestionEssayAPIRequest;
use App\Models\QuestionEssay;
use App\Repositories\QuestionEssayRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuestionEssayController
 * @package App\Http\Controllers\API
 */

class QuestionEssayAPIController extends ApiController
{
    /** @var  QuestionEssayRepository */
    private $questionEssayRepository;

    public function __construct(QuestionEssayRepository $questionEssayRepo)
    {
        parent::__construct();
        $this->questionEssayRepository = $questionEssayRepo;
    }

    /**
     * Display a listing of the QuestionEssay.
     * GET|HEAD /questionEssays
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->questionEssayRepository->all();
        $data['result'] = $this->questionEssayRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created QuestionEssay in storage.
     * POST /questionEssays
     *
     * @param CreateQuestionEssayAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionEssayAPIRequest $request)
    {
        $input = $request->all();

        $questionEssays = $this->questionEssayRepository->create($input);
        $questionEssays = $this->questionEssayRepository->transform($questionEssays);
        return $this->respondWithSuccess($questionEssays);
    }

    /**
     * Display the specified QuestionEssay.
     * GET|HEAD /questionEssays/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var QuestionEssay $questionEssay */
        $questionEssay = $this->questionEssayRepository->findWithoutFail($id);

        if (empty($questionEssay)) {
            return $this->respondWithError('Question Essay not found');
        }

        $questionEssay = $this->questionEssayRepository->transform($questionEssay);

        return $this->respondWithSuccess($questionEssay);
    }

    /**
     * Update the specified QuestionEssay in storage.
     * PUT/PATCH /questionEssays/{id}
     *
     * @param  int $id
     * @param UpdateQuestionEssayAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionEssayAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionEssay $questionEssay */
        $questionEssay = $this->questionEssayRepository->findWithoutFail($id);

        if (empty($questionEssay)) {
            return $this->sendError('Question Essay not found');
        }

        $questionEssay = $this->questionEssayRepository->update($input, $id);

        return $this->sendResponse($questionEssay->toArray(), 'QuestionEssay updated successfully');
    }

    /**
     * Remove the specified QuestionEssay from storage.
     * DELETE /questionEssays/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionEssay $questionEssay */
        $questionEssay = $this->questionEssayRepository->findWithoutFail($id);

        if (empty($questionEssay)) {
            return $this->respondWithError('Question Essay not found');
        }

        $questionEssay->delete();

        $data['message'] ="Question Essay deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
