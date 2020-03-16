<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCurriculumRequest;
use App\Http\Requests\UpdateCurriculumRequest;
use App\Models\Student;
use App\Repositories\CurriculumRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Curriculum;
use function Helper\Common\imageUrl;

class CurriculumController extends AppBaseController
{
    /** @var  CurriculumRepository */
    private $curriculumRepository;

    public function __construct(CurriculumRepository $curriculumRepo)
    {
        parent::__construct();
        $this->curriculumRepository = $curriculumRepo;
    }







    /**
     * Display a listing of the Curriculum.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->curriculumRepository->pushCriteria(new RequestCriteria($request));
        $curricula = $this->curriculumRepository->all();
        */

        return view('curricula.index');
        /*return view('curricula.index')
             ->with('curricula', $curricula);*/
    }

    public function studentShow(Request $request)
    {
       $student = Student::where("user_id",auth()->id())->first();
       if($student != null) {
           $curr = Curriculum::where("level_id",$student->level_id)->first();
       }
        return view('curricula.student')->with("curr",$curr);
        /*return view('curricula.index')
             ->with('curricula', $curricula);*/
    }

    /**
     * Show the form for creating a new Curriculum.
     *
     * @return Response
     */
    public function create()
    {

        return view('curricula.create');
    }

    /**
     * Store a newly created Curriculum in storage.
     *
     * @param CreateCurriculumRequest $request
     *
     * @return Response
     */
    public function store(CreateCurriculumRequest $request)
    {

        $input = $request->request->all();

        $input['file'] = $this->uploadFile($request,"file",false);

        $curriculum = $this->curriculumRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('curricula.index'));
    }

    /**
     * Display the specified Curriculum.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $curriculum = $this->curriculumRepository->findWithoutFail($id);

        if (empty($curriculum)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('curricula.index'));
        }

        return view('curricula.show')->with('curriculum', $curriculum);
    }

    /**
     * Show the form for editing the specified Curriculum.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $curriculum = $this->curriculumRepository->findWithoutFail($id);

        if (empty($curriculum)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('curricula.index'));
        }

        return view('curricula.edit')->with('curriculum', $curriculum);
    }

    /**
     * Update the specified Curriculum in storage.
     *
     * @param  int              $id
     * @param UpdateCurriculumRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCurriculumRequest $request)
    {


        $curriculum = $this->curriculumRepository->findWithoutFail($id);

        if (empty($curriculum)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('curricula.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("file"))
            $input['file'] = $this->uploadFile($request,"file",false);

        $curriculum = $this->curriculumRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('curricula.index'));
    }

    /**
     * Remove the specified Curriculum from storage.
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
                 $this->curriculumRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('curricula.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('curricula.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->curriculumRepository->delete($id);
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
            $items = new Curriculum();
            $items = $items->join("levels","levels.id","=","curricula.level_id");
            $items = $items->select("curricula.*","levels.name as level");

            return DataTables::eloquent($items)
                ->addColumn('options', function (Curriculum $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('curricula.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                <a type="button" href="'. route('curricula.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(Curriculum $item){
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
                 ->editColumn('image', function (Curriculum $item) {
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
