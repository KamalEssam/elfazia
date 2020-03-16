<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionBankGroupRequest;
use App\Http\Requests\UpdateQuestionBankGroupRequest;
use App\Repositories\QuestionBankGroupRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\QuestionBankGroup;
use function Helper\Common\imageUrl;

class QuestionBankGroupController extends AppBaseController
{
    /** @var  QuestionBankGroupRepository */
    private $questionBankGroupRepository;

    public function __construct(QuestionBankGroupRepository $questionBankGroupRepo)
    {
        parent::__construct();
        $this->questionBankGroupRepository = $questionBankGroupRepo;
    }







    /**
     * Display a listing of the QuestionBankGroup.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionBankGroupRepository->pushCriteria(new RequestCriteria($request));
        $questionBankGroups = $this->questionBankGroupRepository->all();
        */

        return view('question_bank_groups.index');
        /*return view('question_bank_groups.index')
             ->with('questionBankGroups', $questionBankGroups);*/
    }



    /**
     * Show the form for creating a new QuestionBankGroup.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_bank_groups.create');
    }

    /**
     * Store a newly created QuestionBankGroup in storage.
     *
     * @param CreateQuestionBankGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionBankGroupRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $questionBankGroup = $this->questionBankGroupRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('questionBankGroups.index'));
    }

    /**
     * Display the specified QuestionBankGroup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionBankGroup = $this->questionBankGroupRepository->findWithoutFail($id);

        if (empty($questionBankGroup)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionBankGroups.index'));
        }

        return view('question_bank_groups.show')->with('questionBankGroup', $questionBankGroup);
    }

    /**
     * Show the form for editing the specified QuestionBankGroup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionBankGroup = $this->questionBankGroupRepository->findWithoutFail($id);

        if (empty($questionBankGroup)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionBankGroups.index'));
        }

        return view('question_bank_groups.edit')->with('questionBankGroup', $questionBankGroup);
    }

    /**
     * Update the specified QuestionBankGroup in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionBankGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionBankGroupRequest $request)
    {


        $questionBankGroup = $this->questionBankGroupRepository->findWithoutFail($id);

        if (empty($questionBankGroup)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionBankGroups.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $questionBankGroup = $this->questionBankGroupRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questionBankGroups.index'));
    }

    /**
     * Remove the specified QuestionBankGroup from storage.
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
                 $this->questionBankGroupRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questionBankGroups.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questionBankGroups.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionBankGroupRepository->delete($id);
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
            $items = QuestionBankGroup::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (QuestionBankGroup $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('questionBankGroups.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('questionBankGroups.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(QuestionBankGroup $item){
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
                 ->editColumn('image', function (QuestionBankGroup $item) {
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
