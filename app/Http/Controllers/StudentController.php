<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionBank;
use App\Models\QuestionType;
use App\Repositories\StudentRepository;
use App\User;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Student;
use function Helper\Common\imageUrl;
use Illuminate\Support\Collection;

class StudentController extends AppBaseController
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
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->studentRepository->pushCriteria(new RequestCriteria($request));
        $students = $this->studentRepository->all();
        */

        return view('students.index');
        /*return view('students.index')
             ->with('students', $students);*/
    }


    public function banksReport(Request $request)
    {
        $banks = QuestionAnswer::where("student_id",$request->student_id)
            ->groupBy("test_id")
            ->pluck("test_id")
            ->toArray();

        $collection = new Collection();
        foreach ($banks as $bank) {
            if($request->isExam == 1) {
                $bank = QuestionBank::where("id",$bank)->where("is_exam",1)->first();
            } else {
                $bank = QuestionBank::where("id",$bank)->where("is_exam",0)->first();
            }
            if($bank != null) {
                if($request->isExam == 1) {
                    $questions = ExamQuestion::where("exam_id",$bank->id)->pluck("question_id")->toArray();
                    $questions = Question::whereIn("id",$questions);
                } else {
                    $questions = Question::where("bank_id",$bank->id);
                }

                //$questions = ExamQuestion::where("exam_id",$bank->id)->pluck("question_id")->toArray();
                $questions = $questions->sum("grade");
                $bank->totalGrade = $questions;

                $gradeStudent = QuestionAnswer::where("test_id",$bank->id)
                    ->where("student_id",$request->student_id)->sum("grade");
                $bank->studentGrade = $gradeStudent;
                $collection->push($bank);
            }
        }

        return view('students.reports.examReport')
            ->with("collection",$collection)
            ->with("student_id",$request->student_id)
            ->with("isExam",$request->isExam);
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }
    public function bankCorrection(Request $request)
    {

        $typeEssay = QuestionType::where("type_custom","essay")->first();
        if($typeEssay == null) {
            return redirect()->back();
        }

        $questions = Question::where("bank_id",$request->bank_id)
            ->where("question_type_id",$typeEssay->id)
            ->get();

        for($i = 0; $i < $questions->count(); $i++) {
            $answer = QuestionAnswer::where("question_id",$questions[$i]->id)
                ->where("student_id",$request->student_id)->first();
            if($answer != null) {
                $questions[$i]->answer = $answer;
            }
        }


        return view('students.reports.testBank')->with("questions",$questions)
            ->with("student_id",$request->student_id)->with("isExam",$request->isExam);
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }
    public function bankCorrectionStore(Request $request)
    {
        if(isset($request->grade)) {
            foreach ($request->grade as $key => $value) {
                $questionAnswer = QuestionAnswer::find($key);
                if($questionAnswer != null) {
                    $question = Question::find($questionAnswer->question_id);
                    $grade = $value;
                    if($question != null && $value > $question->grade) {
                        $grade = $question->grade;
                    }
                    $questionAnswer->grade = $grade;
                    $questionAnswer->save();
                }
            }
        }
        if($request->isExam == 1) {
            return redirect(route("students.banks")."?student_id=".$request->student_id."&isExam=1");
        } else {
            return redirect(route("students.banks")."?student_id=".$request->student_id);
        }
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }
    /**
     * Show the form for creating a new Student.
     *
     * @return Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param CreateStudentRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);
        $input["password"] = bcrypt($request->input("password"));
        $input["role"] = 2;
        $input["active"] = 1;
        $user = User::create($input);
        $input["user_id"] = $user->id;
        $student = $this->studentRepository->create($input);
        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('students.index'));
    }

    /**
     * Display the specified Student.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('students.index'));
        }
        $student->password = null;


        return view('students.show')->with('student', $student);
    }

    /**
     * Show the form for editing the specified Student.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('students.index'));
        }
        $student->password = null;
        $student->name = $student->user->name;
        $student->email = $student->user->email;
        $student->mobile = $student->user->mobile;
        return view('students.edit')->with('student', $student);
    }

    /**
     * Update the specified Student in storage.
     *
     * @param  int              $id
     * @param UpdateStudentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentRequest $request)
    {


        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('students.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        if($request->input("password") != null) {
            $input["password"] = bcrypt($request->input("password"));
        } else {
            unset($input["password"]);
        }
        $student->user()->update($input);
        $student = $this->studentRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified Student from storage.
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
                 $this->studentRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('students.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('students.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->studentRepository->delete($id);
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
            $items = Student::join("users","users.id","=","students.user_id");
            $items = $items->select("users.name as name","users.email as email","users.mobile as mobile",
                "students.*");

            return DataTables::eloquent($items)
                ->addColumn('options', function (Student $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('students.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('students.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                ->addColumn("questions_bank",function(Student $item){
                    $back = '<a class="btn btn-primary" style="color:white" href="'.route("students.banks").'?student_id='.$item->id.'">';
                    $back.= "تصحيح بنك الأسئلة"."</a>";
                    return $back;
                })
                ->addColumn("exams",function(Student $item){
                    $back = '<a class="btn btn-primary" style="color:white" href="'.route("students.banks").'?student_id='.$item->id.'&isExam=1">';
                    $back.= "تصحيح الأختبارات"."</a>";
                    return $back;
                })
                /*
                 ->addColumn("active",function(Student $item){
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
                 ->editColumn('image', function (Student $item) {
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
