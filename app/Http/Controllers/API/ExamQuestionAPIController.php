<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExamQuestionAPIRequest;
use App\Http\Requests\API\UpdateExamQuestionAPIRequest;
use App\Models\ExamQuestion;
use App\Repositories\ExamQuestionRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ExamQuestionController
 * @package App\Http\Controllers\API
 */

class ExamQuestionAPIController extends ApiController
{
    /** @var  ExamQuestionRepository */
    private $examQuestionRepository;

    public function __construct(ExamQuestionRepository $examQuestionRepo)
    {
        parent::__construct();
        $this->examQuestionRepository = $examQuestionRepo;
    }

    /**
     * Display a listing of the ExamQuestion.
     * GET|HEAD /examQuestions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->examQuestionRepository->all();
        $data['result'] = $this->examQuestionRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created ExamQuestion in storage.
     * POST /examQuestions
     *
     * @param CreateExamQuestionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateExamQuestionAPIRequest $request)
    {
        $input = $request->all();

        $examQuestions = $this->examQuestionRepository->create($input);
        $examQuestions = $this->examQuestionRepository->transform($examQuestions);
        return $this->respondWithSuccess($examQuestions);
    }

    /**
     * Display the specified ExamQuestion.
     * GET|HEAD /examQuestions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var ExamQuestion $examQuestion */
        $examQuestion = $this->examQuestionRepository->findWithoutFail($id);

        if (empty($examQuestion)) {
            return $this->respondWithError('Exam Question not found');
        }

        $examQuestion = $this->examQuestionRepository->transform($examQuestion);

        return $this->respondWithSuccess($examQuestion);
    }

    /**
     * Update the specified ExamQuestion in storage.
     * PUT/PATCH /examQuestions/{id}
     *
     * @param  int $id
     * @param UpdateExamQuestionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamQuestionAPIRequest $request)
    {
        $input = $request->all();

        /** @var ExamQuestion $examQuestion */
        $examQuestion = $this->examQuestionRepository->findWithoutFail($id);

        if (empty($examQuestion)) {
            return $this->sendError('Exam Question not found');
        }

        $examQuestion = $this->examQuestionRepository->update($input, $id);

        return $this->sendResponse($examQuestion->toArray(), 'ExamQuestion updated successfully');
    }

    /**
     * Remove the specified ExamQuestion from storage.
     * DELETE /examQuestions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ExamQuestion $examQuestion */
        $examQuestion = $this->examQuestionRepository->findWithoutFail($id);

        if (empty($examQuestion)) {
            return $this->respondWithError('Exam Question not found');
        }

        $examQuestion->delete();

        $data['message'] ="Exam Question deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
