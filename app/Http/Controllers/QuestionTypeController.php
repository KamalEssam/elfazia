<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionTypeRequest;
use App\Http\Requests\UpdateQuestionTypeRequest;
use App\Repositories\QuestionTypeRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\QuestionType;
use function Helper\Common\imageUrl;

class QuestionTypeController extends AppBaseController
{
    /** @var  QuestionTypeRepository */
    private $questionTypeRepository;

    public function __construct(QuestionTypeRepository $questionTypeRepo)
    {
        parent::__construct();
        $this->questionTypeRepository = $questionTypeRepo;
    }







    /**
     * Display a listing of the QuestionType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionTypeRepository->pushCriteria(new RequestCriteria($request));
        $questionTypes = $this->questionTypeRepository->all();
        */

        return view('question_types.index');
        /*return view('question_types.index')
             ->with('questionTypes', $questionTypes);*/
    }



    /**
     * Show the form for creating a new QuestionType.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_types.create');
    }

    /**
     * Store a newly created QuestionType in storage.
     *
     * @param CreateQuestionTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionTypeRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $questionType = $this->questionTypeRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('questionTypes.index'));
    }

    /**
     * Display the specified QuestionType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionType = $this->questionTypeRepository->findWithoutFail($id);

        if (empty($questionType)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionTypes.index'));
        }

        return view('question_types.show')->with('questionType', $questionType);
    }

    /**
     * Show the form for editing the specified QuestionType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionType = $this->questionTypeRepository->findWithoutFail($id);

        if (empty($questionType)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionTypes.index'));
        }

        return view('question_types.edit')->with('questionType', $questionType);
    }

    /**
     * Update the specified QuestionType in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionTypeRequest $request)
    {


        $questionType = $this->questionTypeRepository->findWithoutFail($id);

        if (empty($questionType)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionTypes.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $questionType = $this->questionTypeRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questionTypes.index'));
    }

    /**
     * Remove the specified QuestionType from storage.
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
                 $this->questionTypeRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questionTypes.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questionTypes.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionTypeRepository->delete($id);
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
            $items = QuestionType::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (QuestionType $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('questionTypes.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
         
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(QuestionType $item){
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
                 ->editColumn('image', function (QuestionType $item) {
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
