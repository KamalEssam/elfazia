<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCancelReasonRequest;
use App\Http\Requests\UpdateCancelReasonRequest;
use App\Repositories\CancelReasonRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\CancelReason;
use function Helper\Common\imageUrl;

class CancelReasonController extends AppBaseController
{
    /** @var  CancelReasonRepository */
    private $cancelReasonRepository;

    public function __construct(CancelReasonRepository $cancelReasonRepo)
    {
        parent::__construct();
        $this->cancelReasonRepository = $cancelReasonRepo;
    }







    /**
     * Display a listing of the CancelReason.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->cancelReasonRepository->pushCriteria(new RequestCriteria($request));
        $cancelReasons = $this->cancelReasonRepository->all();
        */

        return view('cancel_reasons.index');
        /*return view('cancel_reasons.index')
             ->with('cancelReasons', $cancelReasons);*/
    }



    /**
     * Show the form for creating a new CancelReason.
     *
     * @return Response
     */
    public function create()
    {
        return view('cancel_reasons.create');
    }

    /**
     * Store a newly created CancelReason in storage.
     *
     * @param CreateCancelReasonRequest $request
     *
     * @return Response
     */
    public function store(CreateCancelReasonRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $cancelReason = $this->cancelReasonRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('cancelReasons.index'));
    }

    /**
     * Display the specified CancelReason.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cancelReason = $this->cancelReasonRepository->findWithoutFail($id);

        if (empty($cancelReason)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('cancelReasons.index'));
        }

        return view('cancel_reasons.show')->with('cancelReason', $cancelReason);
    }

    /**
     * Show the form for editing the specified CancelReason.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cancelReason = $this->cancelReasonRepository->findWithoutFail($id);

        if (empty($cancelReason)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('cancelReasons.index'));
        }

        return view('cancel_reasons.edit')->with('cancelReason', $cancelReason);
    }

    /**
     * Update the specified CancelReason in storage.
     *
     * @param  int              $id
     * @param UpdateCancelReasonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCancelReasonRequest $request)
    {


        $cancelReason = $this->cancelReasonRepository->findWithoutFail($id);

        if (empty($cancelReason)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('cancelReasons.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $cancelReason = $this->cancelReasonRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('cancelReasons.index'));
    }

    /**
     * Remove the specified CancelReason from storage.
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
                 $this->cancelReasonRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('cancelReasons.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('cancelReasons.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->cancelReasonRepository->delete($id);
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
            $items = CancelReason::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (CancelReason $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('cancelReasons.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                    return $back;
                })
                /*
                 ->addColumn("active",function(CancelReason $item){
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
                 ->editColumn('image', function (CancelReason $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->editColumn("id",function($item){
                    $back = '<div class="checkbox checkbox-danger">';
                    $back.='
                        <input id="'.$item->id.'" type="checkbox" name="ids[]" value="'.$item->id.'">';
                    $back .= '
                        <label for="'.$item->id.'">  </label>
                    </div>';

                    return $back;
                })
                ->rawColumns(['options', 'active'])
                ->escapeColumns([])
                ->make(true);
        }


}
