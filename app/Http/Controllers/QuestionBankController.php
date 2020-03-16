<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionBankRequest;
use App\Http\Requests\UpdateQuestionBankRequest;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionBankGroup;
use App\Models\QuestionOption;
use App\Models\StudentExam;
use App\Repositories\QuestionBankRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\QuestionBank;
use function Helper\Common\imageUrl;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class QuestionBankController extends AppBaseController
{
    /** @var  QuestionBankRepository */
    private $questionBankRepository;

    public function __construct(QuestionBankRepository $questionBankRepo)
    {
        //parent::__construct();
        $this->questionBankRepository = $questionBankRepo;
    }







    /**
     * Display a listing of the QuestionBank.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionBankRepository->pushCriteria(new RequestCriteria($request));
        $questionBanks = $this->questionBankRepository->all();
        */

        return view('question_banks.index');
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }

    public function generateFromBank(Request $request) {
        $banks = explode(",",$request->banks);
        $questions = Question::whereIn("bank_id",$banks)
            ->where("question_power_id",$request->power)->get();

        return $questions;
    }
    public function exams(Request $request)
    {
        /*
            $this->questionBankRepository->pushCriteria(new RequestCriteria($request));
            $questionBanks = $this->questionBankRepository->all();
            */

        return view('question_banks.exams');
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }
    public function student(Request $request)
    {
        return view('question_banks.students.index')->with("isExam",$request->isExam);
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }
    public function studentReport(Request $request)
    {
        $banks = QuestionAnswer::groupBy("test_id")->pluck("test_id")->toArray();
        $collection = new Collection();
        foreach ($banks as $bank) {
            $bank = QuestionBank::where("id",$bank)->where("is_exam",1)->first();
            if($bank != null) {
                $questions = ExamQuestion::where("exam_id",$bank->id)->pluck("question_id")->toArray();
                $questions = Question::whereIn("id",$questions);
                $questions = $questions->sum("grade");
                $bank->totalGrade = $questions;

                $gradeStudent = QuestionAnswer::where("test_id",$bank->id)
                    ->where("student_id",auth()->id())->sum("grade");
                $bank->studentGrade = $gradeStudent;
                $collection->push($bank);
            }
        }

        return view('question_banks.students.examReport')->with("collection",$collection);
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }
    public function testResult(Request $request) {
        /** set guest rule or auth */
        $studentID = auth()->id();
        if($studentID == null) {
            session_start();
            $studentID = session_id();
        }

        $bank = QuestionBank::find($request->bank_id);
        if($bank == null) {
            return view('question_banks.students.testResult');
        }

        if($bank->is_exam == 1) {
            $questions = ExamQuestion::where("exam_id",$bank->id)->pluck("question_id")->toArray();
            $questions = Question::whereIn("id",$questions);
            $questions = $questions->sum("grade");

        } else {
            $questions = $bank->questions()->sum("grade");
        }


        $totalGrades = $questions;
        /** student grade */
        $gradeStudent = QuestionAnswer::where("test_id",$bank->id)
            ->where("student_id",$studentID)->sum("grade");

        return view('question_banks.students.testResult')
            ->with("totalGrades",$totalGrades)
            ->with("studentGrades",$gradeStudent);

    }
    public function checkAnswerAjax(Request $request) {
        $questionModel = Question::find($request->question_id);

        if($questionModel->type->type_custom == "options") {
            if(isset($request->is_true_option)) {
                $trueOption = $request->is_true_option;

                /** @var QuestionOption $option */
                $option = $questionModel->options()->where("is_true",1)->first();
                if($option->id == $trueOption) {
                    return [
                        "success" => true,
                    ];
                } else {
                    $is_file = str_contains($option->title, '/storage' );
                    return [
                        "success" => false,
                        "trueID" => $option->id,
                        "title" => $option->title,
                        "isFile"=> $is_file,
                    ];
                }
            }

        } elseif($questionModel->type->type_custom == "true_or_false") {
            if (isset($request->is_true)) {
                if ($questionModel->is_true == 1) {
                    return [
                        "success" => true,
                    ];
                } else {
                    return [
                        "success" => false,
                    ];
                }
            } else {
                if ($questionModel->is_true == 0) {
                    return [
                        "success" => true,
                    ];
                } else {
                    return [
                        "success" => false,
                    ];
                }
            }

        }
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

    public function studentTest(Request $request)
    {
        $bank = QuestionBank::find($request->bank_id);

        /** set guest rule or auth */
        $studentID = auth()->id();
        if($studentID == null) {
            session_start();
            $studentID = session_id();
        }
        if(isset($request->isRetry) && $request->isRetry == 1) {
            /** student answers */
            $deleteAnswers = QuestionAnswer::where("test_id",$bank->id)
                ->where("student_id",$studentID)->delete();
            if($bank->has_end_time == 1) {
                $checkerStart = StudentExam::where("student_id", $studentID)->where("exam_id", $bank->id)->delete();
            }
        } else {
            $counter = QuestionAnswer::where("test_id",$bank->id)
                ->where("student_id",$studentID)->count("id");
            if($counter == 0) {
                $checkerStart = StudentExam::where("student_id", $studentID)->where("exam_id", $bank->id)->delete();
            }
        }

        /** store in session time start */
        if($request->method() == "GET") {
            //Cookie::queue("start_time", date("Y-m-d H:i:s"));
            if($bank->has_end_time == 1) {
                $checkerStart = StudentExam::where("student_id",$studentID)->where("exam_id",$bank->id)->first();
                if($checkerStart == null) {
                    $model = new StudentExam();
                    $model->student_id = $studentID;
                    $model->exam_id = $bank->id;
                    $model->start_time = time();
                    $model->end_time = strtotime("+$bank->time_of_bank minute");
                    $model->save();
                    $checkerStart = $model;
                } else {

                }
            }
        }

        if($bank->is_exam == 1) {
            $questions = ExamQuestion::where("exam_id",$bank->id)->pluck("question_id")->toArray();
            $questions = Question::whereIn("id",$questions);
        } else {
            $questions = $bank->questions();
        }

        if($bank->shuffle == 1) {
            $questions = $questions->inRandomOrder();
        }

        if(isset($request->questionsIDs)) {
            $questions = $questions->whereIn("id",json_decode($request->questionsIDs))->get();
        } else {
            $questions = $questions->get();
        }
        if($questions->count() == 0) {
            /** finish testing */
            return redirect(route("questionBanks.testResult")."?bank_id=".$bank->id);
        } else {
            /** @var Question $question */
            $question = $questions->first();
        }


        if($bank->shuffle_answers == 1) {
            if($question->type->type_custom == "options" || $question->type->type_custom == "order"
                || $question->type->type_custom == "complete") {
                $question->options = $question->options()->inRandomOrder()->get();

                $collection = new Collection();

                for($i = 0; $i < $question->options->count() ; $i ++) {
                    $string = $this->strip_tags_content($question->options[$i]->title);
                    if($string != "" && !empty($string)) {
                        $collection->push($question->options[$i]);
                    }
                }

                $question->options = $collection->random($collection->count());

            }
        } else {
            if($question->type->type_custom == "options" || $question->type->type_custom == "order"
                || $question->type->type_custom == "complete") {

                $collection = new Collection();
                for($i = 0; $i < $question->options->count() ; $i ++) {
                    $string = $this->strip_tags_content($question->options[$i]->title);
                    if($string != "" && !empty($string)) {
                        $collection->push($question->options[$i]);
                    }
                }

                $question->options = $collection->random($collection->count());
            }
        }

        if($request->method() == "POST") {
            /** check timer */
            if($bank->has_end_time == 1) {
                $checkerStart = StudentExam::where("student_id", $studentID)->where("exam_id", $bank->id)->first();
                if ($checkerStart != null && $checkerStart->end_time <= time()) {
                    Flash::error('تم انتهاء وقت الأختبار');
                    return redirect()->back();
                }
            }
            //dd($request->all());
            $grade = 0;
            $isTrueAnswer = false;
            $questionModel = Question::find($request->question_id);
            if($questionModel->type->type_custom == "options") {
                if(isset($request->is_true_option)) {
                    $trueOption = $request->is_true_option[0];
                    $option = $questionModel->options()->where("is_true",1)->first();
                    if($option->id == $trueOption) {
                        $grade = $questionModel->grade;
                        $isTrueAnswer = true;
                    }
                }

            } else if($questionModel->type->type_custom == "true_or_false") {
                if (isset($request->is_true)) {
                    if ($questionModel->is_true == 1) {
                        $grade = $questionModel->grade;
                        $isTrueAnswer = true;
                    }
                } else {
                    if ($questionModel->is_true == 0) {
                        $grade = $questionModel->grade;
                        $isTrueAnswer = true;
                    }
                }

            } else if($questionModel->type->type_custom == "order") {

                if(isset($request->orderIds)) {
                    $orderIdsArray = explode(",",$request->orderIds);
                    //dd($orderIdsArray);
                    /** get options order by asc */
                    /** check first order */
                    for($i = 1; $i<=count($orderIdsArray); $i++) {
                        $option = $questionModel->options()->where("ordered",$i)->where("id",$orderIdsArray[$i-1])->first();
                        if($option == null) {
                            break;
                        }
                        if($i == count($orderIdsArray)) {
                            $grade = $questionModel->grade;
                            $isTrueAnswer = 1;
                        }
                    }
                }


            } else if($questionModel->type->type_custom == "complete") {
                $answers = $questionModel->options()->get();
                $scoorText = 0;
                $scoorTemp = 0;
                $scoorTemp1 = 0;
                $completedWords = $request->complete;
                $totalGrade = 0;

                $answersArray = $answers->pluck("title")->toArray();
                $answersArray = str_replace("[","",$answersArray);
                $answersArray = str_replace("]","",$answersArray);
                $words = str_replace(" ","",$answersArray);
                //dd($words);
                $wordsCollection = new Collection();
                $scores = [];
                foreach ($words as $word) {
                    $array = explode(",",$word);
                    foreach ($array as $item) {
                        $wordsCollection->push($item);
                    }
                }
                $counter = 0;
                foreach ($completedWords as $completeWord) {
                    foreach($wordsCollection as $wordExploded) {
                        $scoorText = 0;
                        (similar_text($completeWord, $wordExploded,$scoorTemp));
                        (similar_text($wordExploded, $completeWord,$scoorTemp1));

                        if($scoorTemp > $scoorTemp1) {
                            if($scoorText < $scoorTemp) {
                                $scoorText = $scoorTemp;
                            }
                        } else {
                            if($scoorText < $scoorTemp1) {
                                $scoorText = $scoorTemp1;
                            }
                        }
                        $wordGrade = $questionModel->grade/($answers->count());

                        if ($scoorText >= 70 && $scoorText <= 200) {
                            $totalGrade += $wordGrade;
                            break;
                        }
//                        } elseif ($scoorText >= 50 && $scoorText <= 75)  {
//                            $totalGrade += $wordGrade*0.75;
//                            $totalGrade = intval($totalGrade);
//                            break;
//                        }  elseif ($scoorText >= 25 && $scoorText <= 50)  {
//                            $totalGrade = $wordGrade/2;
//                            $totalGrade = intval($totalGrade);
//                            break;
//                        }

                    }
                    $scores[$counter]["score"] = $scoorText;
                    $scores[$counter]["word"] = $completeWord;
                    $counter++;
                }
                $checkTrueGrade = $questionModel->grade/2;
                if($totalGrade > $checkTrueGrade) {
                    $grade = $totalGrade;
                    $isTrueAnswer = 1;
                } else if ($totalGrade == $checkTrueGrade) {
                    $grade = $checkTrueGrade;
                    $isTrueAnswer = 1;
                }

            } else if($questionModel->type->type_custom == "match") {
                if(isset($request->titles) && isset($request->answers)) {
                    if($request->titles == $request->answers) {
                        $grade = $questionModel->grade;
                        $isTrueAnswer = 1;
                    }
                }
            } else if($questionModel->type->type_custom == "essay" && $questionModel->check_answer_by_system == 1) {
               $answers = $questionModel->essayAnswers()->get();
               $scoorText = 0;
               $scoorTemp = 0;
               $scoorTemp1 = 0;
               foreach ($answers as $answer) {
                   $scoorText = 0;
                   (similar_text($request->answer, $answer->answer,$scoorTemp));
                   (similar_text($answer->answer, $request->answer,$scoorTemp1));
                   if($scoorTemp > $scoorTemp1) {
                       if($scoorText < $scoorTemp) {
                           $scoorText = $scoorTemp;
                       }
                   } else {
                       if($scoorText < $scoorTemp1) {
                           $scoorText = $scoorTemp1;
                       }
                   }

//                   if($scoorText < $scoorTemp) {
//                       $scoorText = $scoorTemp;
//                   }
               }
               if ($scoorText >= 75 && $scoorText <= 200) {
                   $grade = $questionModel->grade;
                   $isTrueAnswer = 1;
               } elseif ($scoorText >= 50 && $scoorText <= 75)  {
                   $grade = $questionModel->grade*0.75;
                   $grade = intval($grade);
                   $isTrueAnswer = 1;
               }  elseif ($scoorText >= 25 && $scoorText <= 50)  {
                   $grade = $questionModel->grade/2;
                   $grade = intval($grade);
                   $isTrueAnswer = 1;
               }
            }
            $studenAnswer =  new QuestionAnswer();
            $studenAnswer->question_id = $request->question_id;
            $studenAnswer->answer = $request->answer;
            $studenAnswer->student_id = $studentID;
            $studenAnswer->test_id = $bank->id;
            $studenAnswer->grade = $grade;
            $studenAnswer->is_true_answer = $isTrueAnswer;
            $studenAnswer->save();
            $questionsIDs = json_decode($request->ids);
            $counter = 0;
            foreach ($questionsIDs as $id) {
                if($id == $request->question_id) {
                    unset($questionsIDs[$counter]);
                }
                $counter++;
            }
            sort($questionsIDs);



           return redirect("admin/questionBanks/student/test?bank_id=".$request->bank_id."&questionsIDs=".json_encode($questionsIDs));
        }
        return view('question_banks.students.testBank')->with("bank_id",$bank->id)
            ->with("questions",$question)
            ->with("ids",$questions->pluck("id"));
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }

    public function printBank(Request $request)
    {
        $bank = QuestionBank::find($request->bank_id);


        if($bank->is_exam == 1) {
            $questions = ExamQuestion::where("exam_id",$bank->id)->pluck("question_id")->toArray();
            $questions = Question::whereIn("id",$questions);
        } else {
            $questions = $bank->questions();
        }

        if($bank->shuffle == 1) {
            $questions = $questions->inRandomOrder();
        }

        $questions = $questions->get();

        return view('question_banks.students.printBank')->with("bank_id",$bank->id)
            ->with("questionsArray",$questions);
        /*return view('question_banks.index')
             ->with('questionBanks', $questionBanks);*/
    }

    /**
     * Show the form for creating a new QuestionBank.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_banks.create');
    }
    public function createExam()
    {
        return view('question_banks.createExam');
    }
    /**
     * Store a newly created QuestionBank in storage.
     *
     * @param CreateQuestionBankRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionBankRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        /** @var QuestionBank $questionBank */
        $questionBank = QuestionBank::create($input);

        if($questionBank->guest_hide == 1) {
            $questionBank->link_temp = encrypt($questionBank->id);
        }
        foreach ($input["groups"] as $group) {
            $groupModel = new QuestionBankGroup();
            $groupModel->bank_id = $questionBank->id;
            $groupModel->group_id = $group;
            $groupModel->save();
        }

        if(isset($input['is_exam']) && $input['is_exam'] == 1) {
            $input["code"] = str_random(8);
            $input["code"] = strtolower($input["code"]);
            $questionBank->code = $input["code"];

            $questions = array();
            if(isset($input["questions"])) {
                $questions = Question::whereIn("id",$input["questions"])->get();
            } else {
                if(isset($input["power_by_bank"]) && $input["power_by_bank"] == 1 && isset($input["banks"]) && isset($input["num_of_questions"])) {
                    $questions = Question::whereIn("bank_id", $input["banks"])
                        ->where("question_power_id", $input["question_power_id"])->get();
                    if ($questions->count() >= $input["num_of_questions"]) {
                        $questions = $questions->random($input["num_of_questions"]);
                    }
                }
            }

            foreach ($questions as $question) {
                $model = new ExamQuestion();
                $model->exam_id = $questionBank->id;
                $model->question_id = $question->id;
                $model->save();
            }

        }
        $questionBank->save();


        Flash::success('تم حفظ البيانات بنجاح');

        if($questionBank->is_exam == 1) {
            return redirect(route('questionBanks.exams'));
        } else {
            return redirect(route('questionBanks.index'));

        }
    }

    /**
     * Display the specified QuestionBank.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /*** decrypt form guests **/
        try {
            $decodeID = decrypt($id);

        } catch (\Exception $e) {
            $decodeID = $id;
        }
       /** @var QuestionBank $questionBank */
        $questionBank = $this->questionBankRepository->findWithoutFail($decodeID);

        if (empty($questionBank)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionBanks.index'));
        }

        return redirect(route("questionBanks.testNow").'?bank_id='.$questionBank->id);
        //return view('question_banks.show')->with('questionBank', $questionBank);
    }

    /**
     * Show the form for editing the specified QuestionBank.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionBank = $this->questionBankRepository->findWithoutFail($id);

        if (empty($questionBank)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionBanks.index'));
        }

        return view('question_banks.edit')->with('questionBank', $questionBank);
    }

    /**
     * Update the specified QuestionBank in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionBankRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionBankRequest $request)
    {


        $questionBank = $this->questionBankRepository->findWithoutFail($id);

        if (empty($questionBank)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionBanks.index'));
        }


        $input = $request->request->all();


        if(!isset($input["description_hide"])) {
            $input["description_hide"] = 0;
        }
        if(!isset($input["retry_hide"])) {
            $input["retry_hide"] = 0;
        }
        if(!isset($input["shuffle"])) {
            $input["shuffle"] = 0;
        }
        if(!isset($input["shuffle_answers"])) {
            $input["shuffle_answers"] = 0;
        }
        if(!isset($input["has_end_time"])) {
            $input["has_end_time"] = 0;
        }
        if(!isset($input["full_display"])) {
            $input["full_display"] = 0;
        }
        if(!isset($input["guest_hide"])) {
            $input["guest_hide"] = 0;
        }
        if(!isset($input["must_answer_all_bank"])) {
            $input["must_answer_all_bank"] = 0;
        }
        if(!isset($input["power_question_hide"])) {
            $input["power_question_hide"] = 0;
        }

        /** @var QuestionBank $questionBank */
        $questionBank = $this->questionBankRepository->update($input, $id);

        if($input["groups"] != null) {
            $questionBank->groups()->delete();
            foreach ($input["groups"] as $group) {
                $groupModel = new QuestionBankGroup();
                $groupModel->bank_id = $questionBank->id;
                $groupModel->group_id = $group;
                $groupModel->save();
            }
        }

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questionBanks.index'));
    }

    /**
     * Remove the specified QuestionBank from storage.
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
                 $this->questionBankRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questionBanks.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questionBanks.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionBankRepository->delete($id);
                QuestionBankGroup::where("bank_id",$id)->delete();
                Question::where("bank_id",$id)->delete();
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
        $items = new QuestionBank();
        $items = $items->where("is_exam",0);
        $items = $items->join("levels","levels.id","=","question_banks.level_id");
        $items = $items->select("question_banks.*","levels.name as level");

            return DataTables::eloquent($items)
                ->addColumn('options', function (QuestionBank $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('questionBanks.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('questionBanks.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                ->addColumn("share",function(QuestionBank $item){
                    if($item->guest_hide == 1) {
                        $link_temp = url("admin/questionBanks/$item->link_temp");
                        $back ='<a href="http://www.facebook.com/sharer.php?u='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" width="25" alt="Facebook" />
    </a>';
                        $back .=' <a href="https://twitter.com/share?url='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" width="25" alt="Twitter" />
    </a>';
                        $back .='<a href="mailto:?Subject=Question Bank link&amp;Body='.$link_temp.'">
        <img src="https://simplesharebuttons.com/images/somacro/email.png" width="25" alt="Email" />
    </a>';
                        $back .= '<a href="https://plus.google.com/share?url='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/google.png" width="25" alt="Google" />
    </a>';
                    } else {
                        $back = "";
                    }

                    return $back;
                })
                ->addColumn("questions",function(QuestionBank $item){
                    $back = '<a class="btn btn-primary" style="color:white" href="'.route("questions.index").'?bank_id='.$item->id.'">';
                    $back.= "الأسئلة"."</a>";
                    return $back;
                })
                ->addColumn("print",function(QuestionBank $item){
                    $back = '<a class="btn btn-primary" style="color:white" href="'.route("questionBanks.printBank").'?bank_id='.$item->id.'">';
                    $back.= "طباعة"."</a>";
                    return $back;
                })
                /*
                 ->addColumn("active",function(QuestionBank $item){
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
                 ->editColumn('image', function (QuestionBank $item) {
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


    public function dataExams() {
        $items = new QuestionBank();
        $items = $items->where("is_exam",1);
        $items = $items->join("levels","levels.id","=","question_banks.level_id");
        $items = $items->select("question_banks.*","levels.name as level");

        return DataTables::eloquent($items)
            ->addColumn('options', function (QuestionBank $item) {
                $back = ' <div class="btn-group">';
                $back .= '
                <a type="button" href="'. route('questionBanks.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('questionBanks.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                return $back;


            })
            ->addColumn("share",function(QuestionBank $item){
                if($item->guest_hide == 1) {
                    $link_temp = url("admin/questionBanks/$item->link_temp");
                    $back ='<a href="http://www.facebook.com/sharer.php?u='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" width="25" alt="Facebook" />
    </a>';
                    $back .=' <a href="https://twitter.com/share?url='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" width="25" alt="Twitter" />
    </a>';
                    $back .='<a href="mailto:?Subject=Question Bank link&amp;Body='.$link_temp.'">
        <img src="https://simplesharebuttons.com/images/somacro/email.png" width="25" alt="Email" />
    </a>';
                    $back .= '<a href="https://plus.google.com/share?url='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/google.png" width="25" alt="Google" />
    </a>';
                } else {
                    $back = "";
                }

                return $back;
            })
            ->addColumn("questions",function(QuestionBank $item){
                $back = '<a class="btn btn-primary" style="color:white" href="'.route("questions.index").'?bank_id='.$item->id.'">';
                $back.= "الأسئلة"."</a>";
                return $back;
            })
            ->addColumn("print",function(QuestionBank $item){
                $back = '<a class="btn btn-primary" style="color:white" href="'.route("questionBanks.printBank").'?bank_id='.$item->id.'">';
                $back.= "طباعة"."</a>";
                return $back;
            })
            /*
             ->addColumn("active",function(QuestionBank $item){
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
             ->editColumn('image', function (QuestionBank $item) {
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


    public function dataStudent(Request $request) {
        $items = new QuestionBank();
        if($request->isExam == 1) {
            $items = $items->where("is_exam",1);
        } else {
            $items = $items->where("is_exam",0);
        }
        $items = $items->join("levels","levels.id","=","question_banks.level_id");
        $items = $items->select("question_banks.*","levels.name as level");

        return DataTables::eloquent($items)
            ->addColumn('options', function (QuestionBank $item) {
                $back = ' <div class="btn-group">';
                $back .= '
                <a type="button" href="'. route('questionBanks.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('questionBanks.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                return $back;


            })
            ->addColumn("share",function(QuestionBank $item){
                if($item->guest_hide == 1) {
                    $link_temp = url("admin/questionBanks/$item->link_temp");
                    $back ='<a href="http://www.facebook.com/sharer.php?u='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" width="25" alt="Facebook" />
    </a>';
                    $back .=' <a href="https://twitter.com/share?url='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" width="25" alt="Twitter" />
    </a>';
                    $back .='<a href="mailto:?Subject=Question Bank link&amp;Body='.$link_temp.'">
        <img src="https://simplesharebuttons.com/images/somacro/email.png" width="25" alt="Email" />
    </a>';
                    $back .= '<a href="https://plus.google.com/share?url='.$link_temp.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/google.png" width="25" alt="Google" />
    </a>';
                } else {
                    $back = "";
                }

                return $back;
            })

            ->addColumn("test_now",function(QuestionBank $item){
                /**  check if student tested before  */
                if($item->retry_hide == 1) {
                    $questions = QuestionAnswer::where("student_id",auth()->id())->where("test_id",$item->id)->count();
                    if($questions > 0) {
                        return "";
                    } else {
                        $back = '<a class="btn btn-primary" style="color:white" href="'.route("questionBanks.testNow").'?bank_id='.$item->id.'">';
                        $back.= "الأسئلة"."</a>";
                        return $back;
                    }
                } else {
                    $questions = QuestionAnswer::where("student_id",auth()->id())->where("test_id",$item->id)->count();
                    if($questions > 0) {
                        $back = '<a class="btn btn-primary" style="color:white" href="'.route("questionBanks.testNow").'?bank_id='.$item->id.'&isRetry=1">';
                        $back.= "اعادة المحاولة"."</a>";
                        return $back;
                    } else {
                        $back = '<a class="btn btn-primary" style="color:white" href="'.route("questionBanks.testNow").'?bank_id='.$item->id.'">';
                        $back.= "الأسئلة"."</a>";
                        return $back;
                    }
                }


            })
            /*
             ->addColumn("active",function(QuestionBank $item){
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
             ->editColumn('image', function (QuestionBank $item) {
                $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                return $back;
             })
             */
            ->editColumn("id",function($item){
                return "";
            })
            ->rawColumns(['options', 'active'])
            ->escapeColumns([])
            ->make(true);
    }




}
