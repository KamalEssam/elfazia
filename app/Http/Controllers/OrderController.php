<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use App\User;
use function Helper\Common\__lang;
use function Helper\Common\sendNoti;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Order;
use function Helper\Common\imageUrl;
use Illuminate\Support\Collection;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        parent::__construct();
        $this->orderRepository = $orderRepo;
    }







    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->orderRepository->pushCriteria(new RequestCriteria($request));
        $orders = $this->orderRepository->all();
        */

        return view('orders.index')->with("user_id",$request->user_id)->with("delivery_id",$request->delivery_id);
        /*return view('orders.index')
             ->with('orders', $orders);*/
    }



    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $order = $this->orderRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {


        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('orders.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $order = $this->orderRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function setDelivery($id,$delivery_id)
    {
        $order = Order::find($id);
        $delivery = User::find($delivery_id);
        if($order == null || $delivery == null){
            $data['message'] = 'برجاء تحديد بيانات صحيحة';
            $data['success'] = false;
            return $data;
        }

        if($order->status > 2){
            $data['message'] = 'هذا الطلب لدية مندوب من قبل';
            $data['success'] = false;
            return $data;
        }

        $order->delivery_id = $delivery_id;
        $order->status = 1;
        $order->save();

        /** send notification */
        /** @var User $fromClient */
        $fromClient = $order->fromClient;
        if($fromClient != null){
            $message = __lang("the_order_no").$order->uniqueID." ".__lang("is_now_assigned_to_delivery");
            $extras["type"] = 1;
            $extras["result"] = $order->transform();
            sendNoti($fromClient->device_token , $message ,null , $fromClient->device_type);
        }

        /** send notification to delivery */
        $message = __lang("the_order_no").$order->uniqueID." ".__lang("is_now_assigned_to_you");
        $extras["type"] = 1;
        $extras["result"] = $order->transform();
        sendNoti($delivery->device_token , $message ,null , $delivery->device_type);


        //
        $data['message'] = 'تم التعديل بنجاح';
        $data['success'] = true;
        return $data;

    }
    public function destroy(Request $request)
    {
        /*
         if($request->ids != null AND count($request->ids) > 0)
         {
             foreach ($request->ids as $id)
             {
                 $this->orderRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('orders.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('orders.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->orderRepository->delete($id);
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
    public function data(Request $request) {
            $items = new Order();
            if($request->user_id != 0){
                $items = $items->where("from_client_id",$request->user_id);
            }else if ($request->delivery_id != 0){
                $items = $items->where("delivery_id",$request->delivery_id);
            }
            $items = $items->select();
            /** @var Collection $deliveries */
            $deliveries = User::where("role",User::$roles["delivery"])->where("online",1)->select(["id","name"])->get();
            return DataTables::eloquent($items)
                ->addColumn('options', function (Order $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('orders.show' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                    </div>';
                    return $back;
                })
                /*
                 ->addColumn("active",function(Order $item){
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
                 ->editColumn('image', function (Order $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->addColumn('from_client', function (Order $item) {
                   if($item->fromClient != null){
                       return $item->fromClient->name;
                   }else{
                       return "";
                   }
                })
                ->addColumn('to_client', function (Order $item) {
                    if($item->toClient != null){
                        return $item->toClient->name;
                    }else{
                        return "";
                    }
                })
                ->addColumn('delivery', function (Order $item) use($deliveries) {

                    if($item->delivery != null){
                        //return $item->delivery->name;
                        $back = '
         <select name="status"  class="form-control status_id" data-id="' . $item->id . '" >
             <option value="">'.$item->delivery->name.'</option>';
                        for ($i = 0; $i < count($deliveries); $i++) {
                            if($deliveries[$i]->id == $item->delivery_id){
                                continue;
                            }
                            $back .= '<option value="';
                            $back .= $deliveries[$i]->id . '">' .  $deliveries[$i]->name . "</option>";
                        }

                        $back .= '</select>
                    <span class="highlight"></span> <span class="bar"></span>
                    ';
                        return $back;

                    }else{

                        $back = '
         <select name="status"  class="form-control status_id" data-id="' . $item->id . '" >
             <option value="">اختار المندوب</option>';
                        for ($i = 0; $i < count($deliveries); $i++) {
                            $back .= '<option value="';
                            $back .= $deliveries[$i]->id . '">' .  $deliveries[$i]->name . "</option>";
                        }

                        $back .= '</select>
                    <span class="highlight"></span> <span class="bar"></span>
                    ';
                        return $back;
                    }
                })


                ->addColumn('shippment_type', function (Order $item) {
                    return Order::$shippmentTypeText[$item->shippment_type];
                })
                ->addColumn('status', function (Order $item) {
                    return __lang(Order::$statusesText[$item->status]);
                })
                ->addColumn('cash_collected', function (Order $item) {
                    if($item->cash_collected){
                        return "يوجد";
                    }else{
                        return "لا يوجد";
                    }
                })
                ->addColumn("messages",function(Order $item){
                    $back = ' <button type="button" class="btn btn-primary" data-toggle="modal" id="chatRoom" data-id="' . $item->id . '" data-target="#myModal1">
      الرسائل
        </button>';
                    return $back;
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
