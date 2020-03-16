<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionOptionAPIRequest;
use App\Http\Requests\API\UpdateQuestionOptionAPIRequest;
use App\Models\QuestionOption;
use App\Repositories\QuestionOptionRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuestionOptionController
 * @package App\Http\Controllers\API
 */

class QuestionOptionAPIController extends ApiController
{
    /** @var  QuestionOptionRepository */
    private $questionOptionRepository;

    public function __construct(QuestionOptionRepository $questionOptionRepo)
    {
        parent::__construct();
        $this->questionOptionRepository = $questionOptionRepo;
    }

    /**
     * Display a listing of the QuestionOption.
     * GET|HEAD /questionOptions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->questionOptionRepository->all();
        $data['result'] = $this->questionOptionRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created QuestionOption in storage.
     * POST /questionOptions
     *
     * @param CreateQuestionOptionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionOptionAPIRequest $request)
    {
        $input = $request->all();

        $questionOptions = $this->questionOptionRepository->create($input);
        $questionOptions = $this->questionOptionRepository->transform($questionOptions);
        return $this->respondWithSuccess($questionOptions);
    }

    /**
     * Display the specified QuestionOption.
     * GET|HEAD /questionOptions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var QuestionOption $questionOption */
        $questionOption = $this->questionOptionRepository->findWithoutFail($id);

        if (empty($questionOption)) {
            return $this->respondWithError('Question Option not found');
        }

        $questionOption = $this->questionOptionRepository->transform($questionOption);

        return $this->respondWithSuccess($questionOption);
    }

    /**
     * Update the specified QuestionOption in storage.
     * PUT/PATCH /questionOptions/{id}
     *
     * @param  int $id
     * @param UpdateQuestionOptionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionOptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionOption $questionOption */
        $questionOption = $this->questionOptionRepository->findWithoutFail($id);

        if (empty($questionOption)) {
            return $this->sendError('Question Option not found');
        }

        $questionOption = $this->questionOptionRepository->update($input, $id);

        return $this->sendResponse($questionOption->toArray(), 'QuestionOption updated successfully');
    }

    /**
     * Remove the specified QuestionOption from storage.
     * DELETE /questionOptions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionOption $questionOption */
        $questionOption = $this->questionOptionRepository->findWithoutFail($id);

        if (empty($questionOption)) {
            return $this->respondWithError('Question Option not found');
        }

        $questionOption->delete();

        $data['message'] ="Question Option deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
