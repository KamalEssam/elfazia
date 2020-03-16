<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionOptionRequest;
use App\Http\Requests\UpdateQuestionOptionRequest;
use App\Repositories\QuestionOptionRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\QuestionOption;
use function Helper\Common\imageUrl;

class QuestionOptionController extends AppBaseController
{
    /** @var  QuestionOptionRepository */
    private $questionOptionRepository;

    public function __construct(QuestionOptionRepository $questionOptionRepo)
    {
        parent::__construct();
        $this->questionOptionRepository = $questionOptionRepo;
    }







    /**
     * Display a listing of the QuestionOption.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionOptionRepository->pushCriteria(new RequestCriteria($request));
        $questionOptions = $this->questionOptionRepository->all();
        */

        return view('question_options.index');
        /*return view('question_options.index')
             ->with('questionOptions', $questionOptions);*/
    }



    /**
     * Show the form for creating a new QuestionOption.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_options.create');
    }

    /**
     * Store a newly created QuestionOption in storage.
     *
     * @param CreateQuestionOptionRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionOptionRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $questionOption = $this->questionOptionRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('questionOptions.index'));
    }

    /**
     * Display the specified QuestionOption.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionOption = $this->questionOptionRepository->findWithoutFail($id);

        if (empty($questionOption)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionOptions.index'));
        }

        return view('question_options.show')->with('questionOption', $questionOption);
    }

    /**
     * Show the form for editing the specified QuestionOption.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionOption = $this->questionOptionRepository->findWithoutFail($id);

        if (empty($questionOption)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionOptions.index'));
        }

        return view('question_options.edit')->with('questionOption', $questionOption);
    }

    /**
     * Update the specified QuestionOption in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionOptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionOptionRequest $request)
    {


        $questionOption = $this->questionOptionRepository->findWithoutFail($id);

        if (empty($questionOption)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionOptions.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $questionOption = $this->questionOptionRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questionOptions.index'));
    }

    /**
     * Remove the specified QuestionOption from storage.
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
                 $this->questionOptionRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questionOptions.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questionOptions.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionOptionRepository->delete($id);
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
            $items = QuestionOption::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (QuestionOption $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('questionOptions.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('questionOptions.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(QuestionOption $item){
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
                 ->editColumn('image', function (QuestionOption $item) {
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
