<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentExamAPIRequest;
use App\Http\Requests\API\UpdateStudentExamAPIRequest;
use App\Models\StudentExam;
use App\Repositories\StudentExamRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StudentExamController
 * @package App\Http\Controllers\API
 */

class StudentExamAPIController extends ApiController
{
    /** @var  StudentExamRepository */
    private $studentExamRepository;

    public function __construct(StudentExamRepository $studentExamRepo)
    {
        parent::__construct();
        $this->studentExamRepository = $studentExamRepo;
    }

    /**
     * Display a listing of the StudentExam.
     * GET|HEAD /studentExams
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->studentExamRepository->all();
        $data['result'] = $this->studentExamRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created StudentExam in storage.
     * POST /studentExams
     *
     * @param CreateStudentExamAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentExamAPIRequest $request)
    {
        $input = $request->all();

        $studentExams = $this->studentExamRepository->create($input);
        $studentExams = $this->studentExamRepository->transform($studentExams);
        return $this->respondWithSuccess($studentExams);
    }

    /**
     * Display the specified StudentExam.
     * GET|HEAD /studentExams/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var StudentExam $studentExam */
        $studentExam = $this->studentExamRepository->findWithoutFail($id);

        if (empty($studentExam)) {
            return $this->respondWithError('Student Exam not found');
        }

        $studentExam = $this->studentExamRepository->transform($studentExam);

        return $this->respondWithSuccess($studentExam);
    }

    /**
     * Update the specified StudentExam in storage.
     * PUT/PATCH /studentExams/{id}
     *
     * @param  int $id
     * @param UpdateStudentExamAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentExamAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentExam $studentExam */
        $studentExam = $this->studentExamRepository->findWithoutFail($id);

        if (empty($studentExam)) {
            return $this->sendError('Student Exam not found');
        }

        $studentExam = $this->studentExamRepository->update($input, $id);

        return $this->sendResponse($studentExam->toArray(), 'StudentExam updated successfully');
    }

    /**
     * Remove the specified StudentExam from storage.
     * DELETE /studentExams/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var StudentExam $studentExam */
        $studentExam = $this->studentExamRepository->findWithoutFail($id);

        if (empty($studentExam)) {
            return $this->respondWithError('Student Exam not found');
        }

        $studentExam->delete();

        $data['message'] ="Student Exam deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
