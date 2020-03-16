<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionTypeAPIRequest;
use App\Http\Requests\API\UpdateQuestionTypeAPIRequest;
use App\Models\QuestionType;
use App\Repositories\QuestionTypeRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuestionTypeController
 * @package App\Http\Controllers\API
 */

class QuestionTypeAPIController extends ApiController
{
    /** @var  QuestionTypeRepository */
    private $questionTypeRepository;

    public function __construct(QuestionTypeRepository $questionTypeRepo)
    {
        parent::__construct();
        $this->questionTypeRepository = $questionTypeRepo;
    }

    /**
     * Display a listing of the QuestionType.
     * GET|HEAD /questionTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->questionTypeRepository->all();
        $data['result'] = $this->questionTypeRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created QuestionType in storage.
     * POST /questionTypes
     *
     * @param CreateQuestionTypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionTypeAPIRequest $request)
    {
        $input = $request->all();

        $questionTypes = $this->questionTypeRepository->create($input);
        $questionTypes = $this->questionTypeRepository->transform($questionTypes);
        return $this->respondWithSuccess($questionTypes);
    }

    /**
     * Display the specified QuestionType.
     * GET|HEAD /questionTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var QuestionType $questionType */
        $questionType = $this->questionTypeRepository->findWithoutFail($id);

        if (empty($questionType)) {
            return $this->respondWithError('Question Type not found');
        }

        $questionType = $this->questionTypeRepository->transform($questionType);

        return $this->respondWithSuccess($questionType);
    }

    /**
     * Update the specified QuestionType in storage.
     * PUT/PATCH /questionTypes/{id}
     *
     * @param  int $id
     * @param UpdateQuestionTypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionType $questionType */
        $questionType = $this->questionTypeRepository->findWithoutFail($id);

        if (empty($questionType)) {
            return $this->sendError('Question Type not found');
        }

        $questionType = $this->questionTypeRepository->update($input, $id);

        return $this->sendResponse($questionType->toArray(), 'QuestionType updated successfully');
    }

    /**
     * Remove the specified QuestionType from storage.
     * DELETE /questionTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionType $questionType */
        $questionType = $this->questionTypeRepository->findWithoutFail($id);

        if (empty($questionType)) {
            return $this->respondWithError('Question Type not found');
        }

        $questionType->delete();

        $data['message'] ="Question Type deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
