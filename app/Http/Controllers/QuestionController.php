<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\ExamQuestion;
use App\Models\QuestionBank;
use App\Models\QuestionDrag;
use App\Models\QuestionEssay;
use App\Models\QuestionOption;
use App\Models\QuestionType;
use App\Repositories\QuestionRepository;
use function Helper\Common\upload;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Question;
use function Helper\Common\imageUrl;
use Illuminate\Support\Collection;

class QuestionController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        parent::__construct();
        $this->questionRepository = $questionRepo;
    }







    /**
     * Display a listing of the Question.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionRepository->pushCriteria(new RequestCriteria($request));
        $questions = $this->questionRepository->all();
        */

        return view('questions.index')->with("bank_id",$request->bank_id);
        /*return view('questions.index')
             ->with('questions', $questions);*/
    }



    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('questions.create')->with("bank_id",$request->bank_id);
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param CreateQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRequest $request)
    {

        $input = $request->request->all();

        $questionType = QuestionType::where("type_custom",$input["question_type_id"])->first();
        if($questionType == null) {
            return redirect(route('questions.index')."?bank_id=".$request->bank_id);
        }
        $input["question_type_id"] = $questionType->id;
        if($questionType->type_custom == "options") {
            $input["title"] = $input["optionTitleInput"];
        } else if($questionType->type_custom == "essay") {
            $input["title"] = $input["essayInput"];
            if(isset($request->check_answer_by_system)) {
                $input['check_answer_by_system'] = $request->check_answer_by_system;
            }
        } else if($questionType->type_custom == "true_or_false") {
            $input["title"] = $input["trueFalseInput"];
        } else if($questionType->type_custom == "order") {
            $input["title"] = $input["orderableTitleInput"];
        } else if($questionType->type_custom == "match") {
            $input["title"] = $input["matchTitleInput"];
        } else if($questionType->type_custom == "complete") {
            $input["title"] = $input["completeTitleInput"];
        }

        //dd($input);
        $input['image'] = $this->uploadFile($request,"image",false);


        $question = $this->questionRepository->create($input);

        /** check if bank is exam or not */
        $bank = QuestionBank::find($request->bank_id);
        if($bank->is_exam == 1) {
            $model = new ExamQuestion();
            $model->question_id = $question->id;
            $model->exam_id = $bank->id;
            $model->save();
        }
        /**  */
        if($questionType->type_custom == "essay") {
            if(isset($request->answers)) {
                foreach ($request->answers as $answer) {
                    $model = new QuestionEssay();
                    $model->question_id = $question->id;
                    $model->answer = $answer;
                    $model->save();
                }
            }
        }
        if($questionType->type_custom == "options") {

            $counter = 0;
            $files = $request->file("files");

            foreach ($input["option"] as $item) {
                $questionOption = new QuestionOption();

                if(isset($files[$counter])) {
                    $questionOption->title = upload($files[$counter], false)["img"];
                } else {
                    $questionOption->title = $item;
                }
                $questionOption->question_id = $question->id;
                if(isset($input["is_true_option"][$counter])) {
                    $questionOption->is_true = 1;
                } else {
                    $questionOption->is_true = 0;
                }


                $string = $this->strip_tags_content($questionOption->title);
                if($string != "" && !empty($string)) {
                    $questionOption->save();
                }
                
                $counter ++;
            }
        } else if($questionType->type_custom == "order") {
            $counter = 0;
            foreach ($input["titleOrders"] as $item) {
                $questionOption = new QuestionOption();
                $questionOption->title = $item;
                $questionOption->ordered = $input["orders"][$counter];
                $questionOption->question_id = $question->id;
                $questionOption->save();

                $counter ++;
            }
        } else if($questionType->type_custom == "match") {
            $counter = 0;
            foreach ($input["title_match"] as $item) {
                $questionOption = new QuestionDrag();
                $questionOption->title = $item;
                $questionOption->answer = $input["answer_match"][$counter];
                $questionOption->question_id = $question->id;
                $questionOption->save();

                $counter ++;
            }
        }  else if($questionType->type_custom == "complete") {
            $counter = 0;
//            $input['titleWords'] = str_replace("[","",$input['titleWords']);
//            $input['titleWords'] = str_replace("]","",$input['titleWords']);
//            $words = str_replace(" ","",$input['titleWords']);
//            $wordsCollection = new Collection();
//            foreach ($words as $word) {
//                $array = explode(",",$word);
//                foreach ($array as $item) {
//                    $wordsCollection->push($item);
//                }
//            }
//            dd($wordsCollection);
            foreach ($input["titleWords"] as $item) {
                $questionOption = new QuestionOption();
                $questionOption->title = $item;
                $questionOption->question_id = $question->id;
                $questionOption->save();
                $counter ++;
            }
        }

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('questions.index')."?bank_id=".$request->bank_id);
    }
    function strip_tags_content($string) {
        // ----- remove HTML TAGs -----
        $string = preg_replace ('/<[^>]*>/', ' ', $string);
        // ----- remove control characters -----
        $string = str_replace("\r", '', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));
        return $string;

    }
    /**
     * Display the specified Question.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->findWithoutFail($id);

        if (empty($question)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questions.index'));
        }

        return view('questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->findWithoutFail($id);

        if (empty($question)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questions.index'));
        }

        return view('questions.edit')->with('question', $question)->with("bank_id",$question->bank_id);
    }

    /**
     * Update the specified Question in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRequest $request)
    {


        $question = $this->questionRepository->findWithoutFail($id);

        if (empty($question)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questions.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $question = $this->questionRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questions.index')."?bank_id=".$question->bank_id);
    }

    /**
     * Remove the specified Question from storage.
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
                 $this->questionRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questions.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questions.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionRepository->delete($id);
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
            $items = new Question();
            /** @var QuestionBank $bank */
            $bank = QuestionBank::find($request->bank_id);
            if($bank->is_exam == 1) {
                $questions = ExamQuestion::where("exam_id", $bank->id)->pluck("question_id")->toArray();
                $items = $items->whereIn("questions.id",$questions);

            } else {
                $items = $items->where("bank_id",$request->bank_id);
            }
            $items = $items->join("question_types","question_types.id","=","questions.question_type_id");
            $items = $items->join("question_powers","question_powers.id","=","questions.question_power_id");
            $items = $items->select(["questions.*","question_types.title as question_type","question_powers.title as question_power"]);

            return DataTables::eloquent($items)
                ->addColumn('options', function (Question $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
               
                <a type="button" href="'. route('questions.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                ->editColumn('title', function (Question $item) {
                    $title =  strip_tags($item->title);
                   return  str_limit($title, 20);
                })

                /*
                 ->addColumn("active",function(Question $item){
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
                 ->editColumn('image', function (Question $item) {
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
