<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAttendanceAPIRequest;
use App\Http\Requests\API\UpdateAttendanceAPIRequest;
use App\Models\Attendance;
use App\Repositories\AttendanceRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AttendanceController
 * @package App\Http\Controllers\API
 */

class AttendanceAPIController extends ApiController
{
    /** @var  AttendanceRepository */
    private $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepo)
    {
        parent::__construct();
        $this->attendanceRepository = $attendanceRepo;
    }

    /**
     * Display a listing of the Attendance.
     * GET|HEAD /attendances
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['result'] = $this->attendanceRepository->all();
        $data['result'] = $this->attendanceRepository->transformCollection($data['result']);
        return $this->respondWithSuccess($data);
    }

    /**
     * Store a newly created Attendance in storage.
     * POST /attendances
     *
     * @param CreateAttendanceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAttendanceAPIRequest $request)
    {
        $input = $request->all();

        $attendances = $this->attendanceRepository->create($input);
        $attendances = $this->attendanceRepository->transform($attendances);
        return $this->respondWithSuccess($attendances);
    }

    /**
     * Display the specified Attendance.
     * GET|HEAD /attendances/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,Request $request)
    {
        /** @var Attendance $attendance */
        $attendance = $this->attendanceRepository->findWithoutFail($id);

        if (empty($attendance)) {
            return $this->respondWithError('Attendance not found');
        }

        $attendance = $this->attendanceRepository->transform($attendance);

        return $this->respondWithSuccess($attendance);
    }

    /**
     * Update the specified Attendance in storage.
     * PUT/PATCH /attendances/{id}
     *
     * @param  int $id
     * @param UpdateAttendanceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttendanceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Attendance $attendance */
        $attendance = $this->attendanceRepository->findWithoutFail($id);

        if (empty($attendance)) {
            return $this->sendError('Attendance not found');
        }

        $attendance = $this->attendanceRepository->update($input, $id);

        return $this->sendResponse($attendance->toArray(), 'Attendance updated successfully');
    }

    /**
     * Remove the specified Attendance from storage.
     * DELETE /attendances/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Attendance $attendance */
        $attendance = $this->attendanceRepository->findWithoutFail($id);

        if (empty($attendance)) {
            return $this->respondWithError('Attendance not found');
        }

        $attendance->delete();

        $data['message'] ="Attendance deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
