<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionDragAPIRequest;
use App\Http\Requests\API\UpdateQuestionDragAPIRequest;
use App\Models\QuestionDrag;
use App\Repositories\QuestionDragRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuestionDragController
 * @package App\Http\Controllers\API
 */

class QuestionDragAPIController extends ApiController
{
    /** @var  QuestionDragRepository */
    private $questionDragRepository;

    public function __construct(QuestionDragRepository $questionDragRepo)
    {
        parent::__construct();
        $this->questionDragRepository = $questionDragRepo;
    }

    /**
     * Display a listing of the QuestionDrag.
     * GET|HEAD /questionDrags
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->questionDragRepository->all();
        $data['result'] = $this->questionDragRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created QuestionDrag in storage.
     * POST /questionDrags
     *
     * @param CreateQuestionDragAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionDragAPIRequest $request)
    {
        $input = $request->all();

        $questionDrags = $this->questionDragRepository->create($input);
        $questionDrags = $this->questionDragRepository->transform($questionDrags);
        return $this->respondWithSuccess($questionDrags);
    }

    /**
     * Display the specified QuestionDrag.
     * GET|HEAD /questionDrags/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var QuestionDrag $questionDrag */
        $questionDrag = $this->questionDragRepository->findWithoutFail($id);

        if (empty($questionDrag)) {
            return $this->respondWithError('Question Drag not found');
        }

        $questionDrag = $this->questionDragRepository->transform($questionDrag);

        return $this->respondWithSuccess($questionDrag);
    }

    /**
     * Update the specified QuestionDrag in storage.
     * PUT/PATCH /questionDrags/{id}
     *
     * @param  int $id
     * @param UpdateQuestionDragAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionDragAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionDrag $questionDrag */
        $questionDrag = $this->questionDragRepository->findWithoutFail($id);

        if (empty($questionDrag)) {
            return $this->sendError('Question Drag not found');
        }

        $questionDrag = $this->questionDragRepository->update($input, $id);

        return $this->sendResponse($questionDrag->toArray(), 'QuestionDrag updated successfully');
    }

    /**
     * Remove the specified QuestionDrag from storage.
     * DELETE /questionDrags/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionDrag $questionDrag */
        $questionDrag = $this->questionDragRepository->findWithoutFail($id);

        if (empty($questionDrag)) {
            return $this->respondWithError('Question Drag not found');
        }

        $questionDrag->delete();

        $data['message'] ="Question Drag deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
