<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCenterRequest;
use App\Http\Requests\UpdateCenterRequest;
use App\Repositories\CenterRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Center;
use function Helper\Common\imageUrl;

class CenterController extends AppBaseController
{
    /** @var  CenterRepository */
    private $centerRepository;

    public function __construct(CenterRepository $centerRepo)
    {
        parent::__construct();
        $this->centerRepository = $centerRepo;
    }







    /**
     * Display a listing of the Center.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->centerRepository->pushCriteria(new RequestCriteria($request));
        $centers = $this->centerRepository->all();
        */

        return view('centers.index');
        /*return view('centers.index')
             ->with('centers', $centers);*/
    }



    /**
     * Show the form for creating a new Center.
     *
     * @return Response
     */
    public function create()
    {
        return view('centers.create');
    }

    /**
     * Store a newly created Center in storage.
     *
     * @param CreateCenterRequest $request
     *
     * @return Response
     */
    public function store(CreateCenterRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $center = $this->centerRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('centers.index'));
    }

    /**
     * Display the specified Center.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $center = $this->centerRepository->findWithoutFail($id);

        if (empty($center)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('centers.index'));
        }

        return view('centers.show')->with('center', $center);
    }

    /**
     * Show the form for editing the specified Center.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $center = $this->centerRepository->findWithoutFail($id);

        if (empty($center)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('centers.index'));
        }

        return view('centers.edit')->with('center', $center);
    }

    /**
     * Update the specified Center in storage.
     *
     * @param  int              $id
     * @param UpdateCenterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCenterRequest $request)
    {


        $center = $this->centerRepository->findWithoutFail($id);

        if (empty($center)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('centers.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $center = $this->centerRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('centers.index'));
    }

    /**
     * Remove the specified Center from storage.
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
                 $this->centerRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('centers.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('centers.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->centerRepository->delete($id);
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


            $items = Center::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (Center $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
                <a type="button" href="'. route('centers.edit' ,[$item->id]).'" class="btn btn-outline-danger btn-icon m-1">
                                                                <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
                 </a>
                
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(Center $item){
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
                 ->editColumn('image', function (Center $item) {
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
