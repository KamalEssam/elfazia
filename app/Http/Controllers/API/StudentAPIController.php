<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentAPIRequest;
use App\Http\Requests\API\UpdateStudentAPIRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StudentController
 * @package App\Http\Controllers\API
 */

class StudentAPIController extends ApiController
{
    /** @var  StudentRepository */
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        parent::__construct();
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the Student.
     * GET|HEAD /students
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->studentRepository->all();
        $data['result'] = $this->studentRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created Student in storage.
     * POST /students
     *
     * @param CreateStudentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentAPIRequest $request)
    {
        $input = $request->all();

        $students = $this->studentRepository->create($input);
        $students = $this->studentRepository->transform($students);
        return $this->respondWithSuccess($students);
    }

    /**
     * Display the specified Student.
     * GET|HEAD /students/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var Student $student */
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            return $this->respondWithError('Student not found');
        }

        $student = $this->studentRepository->transform($student);

        return $this->respondWithSuccess($student);
    }

    /**
     * Update the specified Student in storage.
     * PUT/PATCH /students/{id}
     *
     * @param  int $id
     * @param UpdateStudentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Student $student */
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        $student = $this->studentRepository->update($input, $id);

        return $this->sendResponse($student->toArray(), 'Student updated successfully');
    }

    /**
     * Remove the specified Student from storage.
     * DELETE /students/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            return $this->respondWithError('Student not found');
        }

        $student->delete();

        $data['message'] ="Student deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
