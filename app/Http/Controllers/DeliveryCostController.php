<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeliveryCostRequest;
use App\Http\Requests\UpdateDeliveryCostRequest;
use App\Models\City;
use App\Repositories\DeliveryCostRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\DeliveryCost;
use function Helper\Common\imageUrl;

class DeliveryCostController extends AppBaseController
{
    /** @var  DeliveryCostRepository */
    private $deliveryCostRepository;

    public function __construct(DeliveryCostRepository $deliveryCostRepo)
    {
        parent::__construct();
        $this->deliveryCostRepository = $deliveryCostRepo;
    }







    /**
     * Display a listing of the DeliveryCost.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->deliveryCostRepository->pushCriteria(new RequestCriteria($request));
        $deliveryCosts = $this->deliveryCostRepository->all();
        */

        return view('delivery_costs.index');
        /*return view('delivery_costs.index')
             ->with('deliveryCosts', $deliveryCosts);*/
    }



    /**
     * Show the form for creating a new DeliveryCost.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::transformAll();
        return view('delivery_costs.create')->with(compact("cities"));
    }

    /**
     * Store a newly created DeliveryCost in storage.
     *
     * @param CreateDeliveryCostRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliveryCostRequest $request)
    {
        if(!DeliveryCost::canInsert($request->from_city_id,$request->to_city_id)){
            Flash::error('عفوا لا يمكن اضافة هذه المناطق مرتين');

            return redirect(route('deliveryCosts.index'));
        }



        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $deliveryCost = $this->deliveryCostRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('deliveryCosts.index'));
    }

    /**
     * Display the specified DeliveryCost.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deliveryCost = $this->deliveryCostRepository->findWithoutFail($id);

        if (empty($deliveryCost)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('deliveryCosts.index'));
        }

        return view('delivery_costs.show')->with('deliveryCost', $deliveryCost);
    }

    /**
     * Show the form for editing the specified DeliveryCost.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deliveryCost = $this->deliveryCostRepository->findWithoutFail($id);

        if (empty($deliveryCost)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('deliveryCosts.index'));
        }

        $cities = City::transformAll();
        return view('delivery_costs.edit')->with('deliveryCost', $deliveryCost)->with(compact("cities"));
    }

    /**
     * Update the specified DeliveryCost in storage.
     *
     * @param  int              $id
     * @param UpdateDeliveryCostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliveryCostRequest $request)
    {


        $deliveryCost = $this->deliveryCostRepository->findWithoutFail($id);

        if (empty($deliveryCost)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('deliveryCosts.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",false);

        $deliveryCost = $this->deliveryCostRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('deliveryCosts.index'));
    }

    /**
     * Remove the specified DeliveryCost from storage.
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
                 $this->deliveryCostRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('deliveryCosts.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('deliveryCosts.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->deliveryCostRepository->delete($id);
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
            $items = DeliveryCost::join("cities","cities.id","=","delivery_costs.from_city_id")
                ->select(["delivery_costs.*","cities.name_ar as from_city"]);

            return DataTables::eloquent($items)
                ->addColumn('options', function (DeliveryCost $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('deliveryCosts.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                    return $back;
                })
                /*
                 ->addColumn("active",function(DeliveryCost $item){
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
                 ->editColumn('image', function (DeliveryCost $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->editColumn("to_city",function(DeliveryCost $item){
                    if($item->toCity){
                        return $item->toCity->name_ar;
                    }else{
                        return "";
                    }

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
