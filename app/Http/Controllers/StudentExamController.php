<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentExamRequest;
use App\Http\Requests\UpdateStudentExamRequest;
use App\Repositories\StudentExamRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\StudentExam;
use function Helper\Common\imageUrl;

class StudentExamController extends AppBaseController
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
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->studentExamRepository->pushCriteria(new RequestCriteria($request));
        $studentExams = $this->studentExamRepository->all();
        */

        return view('student_exams.index');
        /*return view('student_exams.index')
             ->with('studentExams', $studentExams);*/
    }



    /**
     * Show the form for creating a new StudentExam.
     *
     * @return Response
     */
    public function create()
    {
        return view('student_exams.create');
    }

    /**
     * Store a newly created StudentExam in storage.
     *
     * @param CreateStudentExamRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentExamRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $studentExam = $this->studentExamRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('studentExams.index'));
    }

    /**
     * Display the specified StudentExam.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $studentExam = $this->studentExamRepository->findWithoutFail($id);

        if (empty($studentExam)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('studentExams.index'));
        }

        return view('student_exams.show')->with('studentExam', $studentExam);
    }

    /**
     * Show the form for editing the specified StudentExam.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $studentExam = $this->studentExamRepository->findWithoutFail($id);

        if (empty($studentExam)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('studentExams.index'));
        }

        return view('student_exams.edit')->with('studentExam', $studentExam);
    }

    /**
     * Update the specified StudentExam in storage.
     *
     * @param  int              $id
     * @param UpdateStudentExamRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentExamRequest $request)
    {


        $studentExam = $this->studentExamRepository->findWithoutFail($id);

        if (empty($studentExam)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('studentExams.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $studentExam = $this->studentExamRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('studentExams.index'));
    }

    /**
     * Remove the specified StudentExam from storage.
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
                 $this->studentExamRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('studentExams.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('studentExams.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->studentExamRepository->delete($id);
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

    public function data() {
            $items = StudentExam::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (StudentExam $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('studentExams.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('studentExams.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(StudentExam $item){
                    if($item->active == 1)
                    {
                        $back = '<a class="btn btn-warning" onclick="changeActive(this)" data-id="'.$item->id.'">';
                        $back.= "اقفال التفعيل"."</a>";
                    }
                    else
                    {
                        $back = '<a class="btn btn-success" onclick="changeActive(this)" data-id="'.$item->id.'">';
                        $back.= "تفعيل"."</a>";
                    }
                    return $back;
                 })
                 ->editColumn('image', function (StudentExam $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->editColumn("id",function($item){
                 $back = '<div class="btn-group">';
                                    $back.='
                                    <label class="checkbox checkbox-primary" for="'.$item->id.'">
                                                <input id="'.$item->id.'" type="checkbox" name="ids[]" value="'.$item->id.'">
                                                <span class="checkmark"></span>
                                            </label>';
                                    $back .= '
                                    </div>';


                    return $back;
                })
                ->rawColumns(['options', 'active'])
                ->escapeColumns([])
                ->make(true);
        }


}
