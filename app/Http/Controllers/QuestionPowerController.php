<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionPowerRequest;
use App\Http\Requests\UpdateQuestionPowerRequest;
use App\Repositories\QuestionPowerRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\QuestionPower;
use function Helper\Common\imageUrl;

class QuestionPowerController extends AppBaseController
{
    /** @var  QuestionPowerRepository */
    private $questionPowerRepository;

    public function __construct(QuestionPowerRepository $questionPowerRepo)
    {
        parent::__construct();
        $this->questionPowerRepository = $questionPowerRepo;
    }







    /**
     * Display a listing of the QuestionPower.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->questionPowerRepository->pushCriteria(new RequestCriteria($request));
        $questionPowers = $this->questionPowerRepository->all();
        */

        return view('question_powers.index');
        /*return view('question_powers.index')
             ->with('questionPowers', $questionPowers);*/
    }



    /**
     * Show the form for creating a new QuestionPower.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_powers.create');
    }

    /**
     * Store a newly created QuestionPower in storage.
     *
     * @param CreateQuestionPowerRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionPowerRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $questionPower = $this->questionPowerRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('questionPowers.index'));
    }

    /**
     * Display the specified QuestionPower.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionPower = $this->questionPowerRepository->findWithoutFail($id);

        if (empty($questionPower)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionPowers.index'));
        }

        return view('question_powers.show')->with('questionPower', $questionPower);
    }

    /**
     * Show the form for editing the specified QuestionPower.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionPower = $this->questionPowerRepository->findWithoutFail($id);

        if (empty($questionPower)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionPowers.index'));
        }

        return view('question_powers.edit')->with('questionPower', $questionPower);
    }

    /**
     * Update the specified QuestionPower in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionPowerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionPowerRequest $request)
    {


        $questionPower = $this->questionPowerRepository->findWithoutFail($id);

        if (empty($questionPower)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('questionPowers.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $questionPower = $this->questionPowerRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('questionPowers.index'));
    }

    /**
     * Remove the specified QuestionPower from storage.
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
                 $this->questionPowerRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('questionPowers.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('questionPowers.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->questionPowerRepository->delete($id);
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
            $items = QuestionPower::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (QuestionPower $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('questionPowers.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(QuestionPower $item){
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
                 ->editColumn('image', function (QuestionPower $item) {
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
