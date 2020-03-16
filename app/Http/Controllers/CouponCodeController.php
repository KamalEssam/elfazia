<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCouponCodeRequest;
use App\Http\Requests\UpdateCouponCodeRequest;
use App\Repositories\CouponCodeRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\CouponCode;
use function Helper\Common\imageUrl;

class CouponCodeController extends AppBaseController
{
    /** @var  CouponCodeRepository */
    private $couponCodeRepository;

    public function __construct(CouponCodeRepository $couponCodeRepo)
    {
        parent::__construct();
        $this->couponCodeRepository = $couponCodeRepo;
    }







    /**
     * Display a listing of the CouponCode.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->couponCodeRepository->pushCriteria(new RequestCriteria($request));
        $couponCodes = $this->couponCodeRepository->all();
        */

        return view('coupon_codes.index');
        /*return view('coupon_codes.index')
             ->with('couponCodes', $couponCodes);*/
    }



    /**
     * Show the form for creating a new CouponCode.
     *
     * @return Response
     */
    public function create()
    {
        return view('coupon_codes.create');
    }

    /**
     * Store a newly created CouponCode in storage.
     *
     * @param CreateCouponCodeRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponCodeRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);
        $input["expire_date"] = strtotime($request->expire_date);
        $couponCode = $this->couponCodeRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('couponCodes.index'));
    }

    /**
     * Display the specified CouponCode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $couponCode = $this->couponCodeRepository->findWithoutFail($id);

        if (empty($couponCode)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('couponCodes.index'));
        }

        return view('coupon_codes.show')->with('couponCode', $couponCode);
    }

    /**
     * Show the form for editing the specified CouponCode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $couponCode = $this->couponCodeRepository->findWithoutFail($id);

        if (empty($couponCode)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('couponCodes.index'));
        }
        $couponCode->expire_date = date("Y-m-d",$couponCode->expire_date);

        return view('coupon_codes.edit')->with('couponCode', $couponCode);
    }

    /**
     * Update the specified CouponCode in storage.
     *
     * @param  int              $id
     * @param UpdateCouponCodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponCodeRequest $request)
    {


        $couponCode = $this->couponCodeRepository->findWithoutFail($id);

        if (empty($couponCode)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('couponCodes.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $input["expire_date"] = strtotime($request->expire_date);
        $couponCode = $this->couponCodeRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('couponCodes.index'));
    }

    /**
     * Remove the specified CouponCode from storage.
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
                 $this->couponCodeRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('couponCodes.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('couponCodes.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->couponCodeRepository->delete($id);
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
            $items = CouponCode::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (CouponCode $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('couponCodes.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                    return $back;
                })
                /*
                 ->addColumn("active",function(CouponCode $item){
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
                 ->editColumn('image', function (CouponCode $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->addColumn('expire_date', function (CouponCode $item) {
                    return date("Y-m-d",$item->expire_date);
                })
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
