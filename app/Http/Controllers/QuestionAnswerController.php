<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionAnswerRequest;
use App\Http\Requests\UpdateQuestionAnswerRequest;
use App\Repositories\QuestionAnswerRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\QuestionAnswer;
use function Helper\Common\imageUrl;

class QuestionAnswerController extends AppBaseController
{
    /** @var  QuestionAnswerRepository */
    private $questionAnswerRepository;

    public function __construct(QuestionAnswerRepository $questionAnswerRepo)
    {
        parent::__construct();
        $this->questionAnswerRepository = $questionAnswerRepo;
    }







    /**
     * Display a listing of the QuestionAnswer.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionAnswerRepository->pushCriteria(new RequestCriteria($request));
        $questionAnswers = $this->questionAnswerRepository->all();
        */

        return view('question_answers.index');
        /*return view('question_answers.index')
             ->with('questionAnswers', $questionAnswers);*/
    }



    /**
     * Show the form for creating a new QuestionAnswer.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_answers.create');
    }

    /**
     * Store a newly created QuestionAnswer in storage.
     *
     * @param CreateQuestionAnswerRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionAnswerRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $questionAnswer = $this->questionAnswerRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('questionAnswers.index'));
    }

    /**
     * Display the specified QuestionAnswer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionAnswer = $this->questionAnswerRepository->findWithoutFail($id);

        if (empty($questionAnswer)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionAnswers.index'));
        }

        return view('question_answers.show')->with('questionAnswer', $questionAnswer);
    }

    /**
     * Show the form for editing the specified QuestionAnswer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionAnswer = $this->questionAnswerRepository->findWithoutFail($id);

        if (empty($questionAnswer)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionAnswers.index'));
        }

        return view('question_answers.edit')->with('questionAnswer', $questionAnswer);
    }

    /**
     * Update the specified QuestionAnswer in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionAnswerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionAnswerRequest $request)
    {


        $questionAnswer = $this->questionAnswerRepository->findWithoutFail($id);

        if (empty($questionAnswer)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionAnswers.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $questionAnswer = $this->questionAnswerRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questionAnswers.index'));
    }

    /**
     * Remove the specified QuestionAnswer from storage.
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
                 $this->questionAnswerRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questionAnswers.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questionAnswers.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionAnswerRepository->delete($id);
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
            $items = QuestionAnswer::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (QuestionAnswer $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('questionAnswers.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('questionAnswers.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(QuestionAnswer $item){
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
                 ->editColumn('image', function (QuestionAnswer $item) {
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
