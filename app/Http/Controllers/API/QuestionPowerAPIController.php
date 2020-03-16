<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionPowerAPIRequest;
use App\Http\Requests\API\UpdateQuestionPowerAPIRequest;
use App\Models\QuestionPower;
use App\Repositories\QuestionPowerRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuestionPowerController
 * @package App\Http\Controllers\API
 */

class QuestionPowerAPIController extends ApiController
{
    /** @var  QuestionPowerRepository */
    private $questionPowerRepository;

    public function __construct(QuestionPowerRepository $questionPowerRepo)
    {
        parent::__construct();
        $this->questionPowerRepository = $questionPowerRepo;
    }

    /**
     * Display a listing of the QuestionPower.
     * GET|HEAD /questionPowers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->questionPowerRepository->all();
        $data['result'] = $this->questionPowerRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created QuestionPower in storage.
     * POST /questionPowers
     *
     * @param CreateQuestionPowerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionPowerAPIRequest $request)
    {
        $input = $request->all();

        $questionPowers = $this->questionPowerRepository->create($input);
        $questionPowers = $this->questionPowerRepository->transform($questionPowers);
        return $this->respondWithSuccess($questionPowers);
    }

    /**
     * Display the specified QuestionPower.
     * GET|HEAD /questionPowers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var QuestionPower $questionPower */
        $questionPower = $this->questionPowerRepository->findWithoutFail($id);

        if (empty($questionPower)) {
            return $this->respondWithError('Question Power not found');
        }

        $questionPower = $this->questionPowerRepository->transform($questionPower);

        return $this->respondWithSuccess($questionPower);
    }

    /**
     * Update the specified QuestionPower in storage.
     * PUT/PATCH /questionPowers/{id}
     *
     * @param  int $id
     * @param UpdateQuestionPowerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionPowerAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionPower $questionPower */
        $questionPower = $this->questionPowerRepository->findWithoutFail($id);

        if (empty($questionPower)) {
            return $this->sendError('Question Power not found');
        }

        $questionPower = $this->questionPowerRepository->update($input, $id);

        return $this->sendResponse($questionPower->toArray(), 'QuestionPower updated successfully');
    }

    /**
     * Remove the specified QuestionPower from storage.
     * DELETE /questionPowers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuestionPower $questionPower */
        $questionPower = $this->questionPowerRepository->findWithoutFail($id);

        if (empty($questionPower)) {
            return $this->respondWithError('Question Power not found');
        }

        $questionPower->delete();

        $data['message'] ="Question Power deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
