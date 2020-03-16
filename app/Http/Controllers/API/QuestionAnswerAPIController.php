<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionAnswerAPIRequest;
use App\Http\Requests\API\UpdateQuestionAnswerAPIRequest;
use App\Models\QuestionAnswer;
use App\Repositories\QuestionAnswerRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuestionAnswerController
 * @package App\Http\Controllers\API
 */

class QuestionAnswerAPIController extends ApiController
{
    /** @var  QuestionAnswerRepository */
    private $questionAnswerRepository;

    public function __construct(QuestionAnswerRepository $questionAnswerRepo)
    {
        parent::__construct();
        $this->questionAnswerRepository = $questionAnswerRepo;
    }

    /**
     * Display a listing of the QuestionAnswer.
     * GET|HEAD /questionAnswers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->questionAnswerRepository->all();
        $data['result'] = $this->questionAnswerRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created QuestionAnswer in storage.
     * POST /questionAnswers
     *
     * @param CreateQuestionAnswerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionAnswerAPIRequest $request)
    {
        $input = $request->all();

        $questionAnswers = $this->questionAnswerRepository->create($input);
        $questionAnswers = $this->questionAnswerRepository->transform($questionAnswers);
        return $this->respondWithSuccess($questionAnswers);
    }

    /**
     * Display the specified QuestionAnswer.
     * GET|HEAD /questionAnswers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var QuestionAnswer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->findWithoutFail($id);

        if (empty($questionAnswer)) {
            return $this->respondWithError('Question Answer not found');
        }

        $questionAnswer = $this->questionAnswerRepository->transform($questionAnswer);

        return $this->respondWithSuccess($questionAnswer);
    }

    /**
     * Update the specified QuestionAnswer in storage.
     * PUT/PATCH /questionAnswers/{id}
     *
     * @param  int $id
     * @param UpdateQuestionAnswerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionAnswerAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionAnswer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->findWithoutFail($id);

        if (empty($questionAnswer)) {
            return $this->sendError('Question Answer not found');
        }

        $questionAnswer = $this->questionAnswerRepository->update($input, $id);

        return $this->sendResponse($questionAnswer->toArray(), 'QuestionAnswer updated successfully');
    }

    /**
     * Remove the specified QuestionAnswer from storage.
     * DELETE /questionAnswers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionAnswer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->findWithoutFail($id);

        if (empty($questionAnswer)) {
            return $this->respondWithError('Question Answer not found');
        }

        $questionAnswer->delete();

        $data['message'] ="Question Answer deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
