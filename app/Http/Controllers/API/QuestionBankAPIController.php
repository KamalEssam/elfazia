<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionBankAPIRequest;
use App\Http\Requests\API\UpdateQuestionBankAPIRequest;
use App\Models\QuestionBank;
use App\Repositories\QuestionBankRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuestionBankController
 * @package App\Http\Controllers\API
 */

class QuestionBankAPIController extends ApiController
{
    /** @var  QuestionBankRepository */
    private $questionBankRepository;

    public function __construct(QuestionBankRepository $questionBankRepo)
    {
        parent::__construct();
        $this->questionBankRepository = $questionBankRepo;
    }

    /**
     * Display a listing of the QuestionBank.
     * GET|HEAD /questionBanks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->questionBankRepository->all();
        $data['result'] = $this->questionBankRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created QuestionBank in storage.
     * POST /questionBanks
     *
     * @param CreateQuestionBankAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionBankAPIRequest $request)
    {
        $input = $request->all();

        $questionBanks = $this->questionBankRepository->create($input);
        $questionBanks = $this->questionBankRepository->transform($questionBanks);
        return $this->respondWithSuccess($questionBanks);
    }

    /**
     * Display the specified QuestionBank.
     * GET|HEAD /questionBanks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var QuestionBank $questionBank */
        $questionBank = $this->questionBankRepository->findWithoutFail($id);

        if (empty($questionBank)) {
            return $this->respondWithError('Question Bank not found');
        }

        $questionBank = $this->questionBankRepository->transform($questionBank);

        return $this->respondWithSuccess($questionBank);
    }

    /**
     * Update the specified QuestionBank in storage.
     * PUT/PATCH /questionBanks/{id}
     *
     * @param  int $id
     * @param UpdateQuestionBankAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionBankAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionBank $questionBank */
        $questionBank = $this->questionBankRepository->findWithoutFail($id);

        if (empty($questionBank)) {
            return $this->sendError('Question Bank not found');
        }

        $questionBank = $this->questionBankRepository->update($input, $id);

        return $this->sendResponse($questionBank->toArray(), 'QuestionBank updated successfully');
    }

    /**
     * Remove the specified QuestionBank from storage.
     * DELETE /questionBanks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionBank $questionBank */
        $questionBank = $this->questionBankRepository->findWithoutFail($id);

        if (empty($questionBank)) {
            return $this->respondWithError('Question Bank not found');
        }

        $questionBank->delete();

        $data['message'] ="Question Bank deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
