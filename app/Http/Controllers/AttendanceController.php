<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Delivery;
use App\Repositories\AttendanceRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Attendance;
use function Helper\Common\imageUrl;

class AttendanceController extends AppBaseController
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
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->attendanceRepository->pushCriteria(new RequestCriteria($request));
        $attendances = $this->attendanceRepository->all();
        */

        return view('attendances.index')->with("attendanceDate",$request->attendanceDate);
        /*return view('attendances.index')
             ->with('attendances', $attendances);*/
    }



    /**
     * Show the form for creating a new Attendance.
     *
     * @return Response
     */
    public function create()
    {
        return view('attendances.create');
    }

    /**
     * Store a newly created Attendance in storage.
     *
     * @param CreateAttendanceRequest $request
     *
     * @return Response
     */
    public function store(CreateAttendanceRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $attendance = $this->attendanceRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('attendances.index'));
    }

    /**
     * Display the specified Attendance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attendance = $this->attendanceRepository->findWithoutFail($id);

        if (empty($attendance)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('attendances.index'));
        }

        return view('attendances.show')->with('attendance', $attendance);
    }

    /**
     * Show the form for editing the specified Attendance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attendance = $this->attendanceRepository->findWithoutFail($id);

        if (empty($attendance)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('attendances.index'));
        }

        return view('attendances.edit')->with('attendance', $attendance);
    }

    /**
     * Update the specified Attendance in storage.
     *
     * @param  int              $id
     * @param UpdateAttendanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttendanceRequest $request)
    {


        $attendance = $this->attendanceRepository->findWithoutFail($id);

        if (empty($attendance)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('attendances.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $attendance = $this->attendanceRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('attendances.index'));
    }

    /**
     * Remove the specified Attendance from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        /*
         if($request->ids != null AND count($request->ids) > 0)
         {
             foreach ($request->ids as $id)
             {
                 $this->attendanceRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('attendances.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('attendances.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->attendanceRepository->delete($id);
            }
        }
        else
        {
            $data['message'] = 'برجاء تحديد بيانات المراد حذفها';
            $data['success'] = false;
            return $data;
        }
        $data['message'] = 'تم الحذف بنجاح';
        $data['success'] = true;
        return $data;

    }

    public function data(Request $request) {
            $date = $request->attendanceDate;
            if($date == null){
                $date = date("Y-m-d");
            }
            $model = new Attendance();
            $model = $model->rightJoin("users","users.id","=","attendances.user_id");
            $model = $model->where("users.role",Delivery::$roles["delivery"]);
            $model = $model->select(["attendances.*","users.name as delivery"])->get();
            $model = Attendance::transformCollection($model,$date);
            return DataTables::collection($model)
                ->addColumn('options', function (Attendance $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('attendances.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                    return $back;
                })
                ->addColumn('attend', function (Attendance $item) {
                    if($item->attend == null){
                        return "غائب";
                    }else{
                        return "حاضر";
                    }
                })
                ->editColumn("id",function($item){
                    $back = '<div class="checkbox checkbox-danger">';
                    $back.='
                        <input id="'.$item->id.'" type="checkbox" name="ids[]" value="'.$item->id.'">';
                    $back .= '
                        <label for="'.$item->id.'">  </label>
                    </div>';

                    return $back;
                })
                ->rawColumns(['options', 'active'])
                ->escapeColumns([])
                ->make(true);
        }


}
