<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExamQuestionRequest;
use App\Http\Requests\UpdateExamQuestionRequest;
use App\Repositories\ExamQuestionRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\ExamQuestion;
use function Helper\Common\imageUrl;

class ExamQuestionController extends AppBaseController
{
    /** @var  ExamQuestionRepository */
    private $examQuestionRepository;

    public function __construct(ExamQuestionRepository $examQuestionRepo)
    {
        parent::__construct();
        $this->examQuestionRepository = $examQuestionRepo;
    }


    /**
     * Display a listing of the ExamQuestion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->examQuestionRepository->pushCriteria(new RequestCriteria($request));
        $examQuestions = $this->examQuestionRepository->all();
        */

        return view('exam_questions.index');
        /*return view('exam_questions.index')
             ->with('examQuestions', $examQuestions);*/
    }



    /**
     * Show the form for creating a new ExamQuestion.
     *
     * @return Response
     */
    public function create()
    {
        return view('exam_questions.create');
    }

    /**
     * Store a newly created ExamQuestion in storage.
     *
     * @param CreateExamQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateExamQuestionRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $examQuestion = $this->examQuestionRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('examQuestions.index'));
    }

    /**
     * Display the specified ExamQuestion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $examQuestion = $this->examQuestionRepository->findWithoutFail($id);

        if (empty($examQuestion)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('examQuestions.index'));
        }

        return view('exam_questions.show')->with('examQuestion', $examQuestion);
    }

    /**
     * Show the form for editing the specified ExamQuestion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $examQuestion = $this->examQuestionRepository->findWithoutFail($id);

        if (empty($examQuestion)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('examQuestions.index'));
        }

        return view('exam_questions.edit')->with('examQuestion', $examQuestion);
    }

    /**
     * Update the specified ExamQuestion in storage.
     *
     * @param  int              $id
     * @param UpdateExamQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamQuestionRequest $request)
    {


        $examQuestion = $this->examQuestionRepository->findWithoutFail($id);

        if (empty($examQuestion)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('examQuestions.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $examQuestion = $this->examQuestionRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('examQuestions.index'));
    }

    /**
     * Remove the specified ExamQuestion from storage.
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
                 $this->examQuestionRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('examQuestions.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('examQuestions.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->examQuestionRepository->delete($id);
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
            $items = ExamQuestion::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (ExamQuestion $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('examQuestions.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('examQuestions.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(ExamQuestion $item){
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
                 ->editColumn('image', function (ExamQuestion $item) {
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
