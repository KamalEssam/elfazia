<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionDragRequest;
use App\Http\Requests\UpdateQuestionDragRequest;
use App\Repositories\QuestionDragRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\QuestionDrag;
use function Helper\Common\imageUrl;

class QuestionDragController extends AppBaseController
{
    /** @var  QuestionDragRepository */
    private $questionDragRepository;

    public function __construct(QuestionDragRepository $questionDragRepo)
    {
        parent::__construct();
        $this->questionDragRepository = $questionDragRepo;
    }







    /**
     * Display a listing of the QuestionDrag.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionDragRepository->pushCriteria(new RequestCriteria($request));
        $questionDrags = $this->questionDragRepository->all();
        */

        return view('question_drags.index');
        /*return view('question_drags.index')
             ->with('questionDrags', $questionDrags);*/
    }



    /**
     * Show the form for creating a new QuestionDrag.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_drags.create');
    }

    /**
     * Store a newly created QuestionDrag in storage.
     *
     * @param CreateQuestionDragRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionDragRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $questionDrag = $this->questionDragRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('questionDrags.index'));
    }

    /**
     * Display the specified QuestionDrag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionDrag = $this->questionDragRepository->findWithoutFail($id);

        if (empty($questionDrag)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionDrags.index'));
        }

        return view('question_drags.show')->with('questionDrag', $questionDrag);
    }

    /**
     * Show the form for editing the specified QuestionDrag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionDrag = $this->questionDragRepository->findWithoutFail($id);

        if (empty($questionDrag)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionDrags.index'));
        }

        return view('question_drags.edit')->with('questionDrag', $questionDrag);
    }

    /**
     * Update the specified QuestionDrag in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionDragRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionDragRequest $request)
    {


        $questionDrag = $this->questionDragRepository->findWithoutFail($id);

        if (empty($questionDrag)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionDrags.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $questionDrag = $this->questionDragRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questionDrags.index'));
    }

    /**
     * Remove the specified QuestionDrag from storage.
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
                 $this->questionDragRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questionDrags.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questionDrags.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionDragRepository->delete($id);
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
            $items = QuestionDrag::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (QuestionDrag $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('questionDrags.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('questionDrags.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(QuestionDrag $item){
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
                 ->editColumn('image', function (QuestionDrag $item) {
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
