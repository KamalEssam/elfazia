<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionEssayRequest;
use App\Http\Requests\UpdateQuestionEssayRequest;
use App\Repositories\QuestionEssayRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\QuestionEssay;
use function Helper\Common\imageUrl;

class QuestionEssayController extends AppBaseController
{
    /** @var  QuestionEssayRepository */
    private $questionEssayRepository;

    public function __construct(QuestionEssayRepository $questionEssayRepo)
    {
        parent::__construct();
        $this->questionEssayRepository = $questionEssayRepo;
    }







    /**
     * Display a listing of the QuestionEssay.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionEssayRepository->pushCriteria(new RequestCriteria($request));
        $questionEssays = $this->questionEssayRepository->all();
        */

        return view('question_essays.index');
        /*return view('question_essays.index')
             ->with('questionEssays', $questionEssays);*/
    }



    /**
     * Show the form for creating a new QuestionEssay.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_essays.create');
    }

    /**
     * Store a newly created QuestionEssay in storage.
     *
     * @param CreateQuestionEssayRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionEssayRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $questionEssay = $this->questionEssayRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('questionEssays.index'));
    }

    /**
     * Display the specified QuestionEssay.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionEssay = $this->questionEssayRepository->findWithoutFail($id);

        if (empty($questionEssay)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionEssays.index'));
        }

        return view('question_essays.show')->with('questionEssay', $questionEssay);
    }

    /**
     * Show the form for editing the specified QuestionEssay.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionEssay = $this->questionEssayRepository->findWithoutFail($id);

        if (empty($questionEssay)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionEssays.index'));
        }

        return view('question_essays.edit')->with('questionEssay', $questionEssay);
    }

    /**
     * Update the specified QuestionEssay in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionEssayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionEssayRequest $request)
    {


        $questionEssay = $this->questionEssayRepository->findWithoutFail($id);

        if (empty($questionEssay)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionEssays.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $questionEssay = $this->questionEssayRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questionEssays.index'));
    }

    /**
     * Remove the specified QuestionEssay from storage.
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
                 $this->questionEssayRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questionEssays.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questionEssays.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionEssayRepository->delete($id);
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
            $items = QuestionEssay::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (QuestionEssay $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('questionEssays.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('questionEssays.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(QuestionEssay $item){
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
                 ->editColumn('image', function (QuestionEssay $item) {
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
