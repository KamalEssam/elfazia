<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Repositories\LevelRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Level;
use function Helper\Common\imageUrl;

class LevelController extends AppBaseController
{
    /** @var  LevelRepository */
    private $levelRepository;

    public function __construct(LevelRepository $levelRepo)
    {
        parent::__construct();
        $this->levelRepository = $levelRepo;
    }







    /**
     * Display a listing of the Level.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->levelRepository->pushCriteria(new RequestCriteria($request));
        $levels = $this->levelRepository->all();
        */

        return view('levels.index');
        /*return view('levels.index')
             ->with('levels', $levels);*/
    }



    /**
     * Show the form for creating a new Level.
     *
     * @return Response
     */
    public function create()
    {
        return view('levels.create');
    }

    /**
     * Store a newly created Level in storage.
     *
     * @param CreateLevelRequest $request
     *
     * @return Response
     */
    public function store(CreateLevelRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $level = $this->levelRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('levels.index'));
    }

    /**
     * Display the specified Level.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $level = $this->levelRepository->findWithoutFail($id);

        if (empty($level)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('levels.index'));
        }

        return view('levels.show')->with('level', $level);
    }

    /**
     * Show the form for editing the specified Level.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $level = $this->levelRepository->findWithoutFail($id);

        if (empty($level)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('levels.index'));
        }

        return view('levels.edit')->with('level', $level);
    }

    /**
     * Update the specified Level in storage.
     *
     * @param  int              $id
     * @param UpdateLevelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLevelRequest $request)
    {


        $level = $this->levelRepository->findWithoutFail($id);

        if (empty($level)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('levels.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $level = $this->levelRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('levels.index'));
    }

    /**
     * Remove the specified Level from storage.
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
                 $this->levelRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('levels.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('levels.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->levelRepository->delete($id);
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
            $items = Level::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (Level $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('levels.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
     
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(Level $item){
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
                 ->editColumn('image', function (Level $item) {
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
