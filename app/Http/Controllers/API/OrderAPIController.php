<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderAPIRequest;
use App\Http\Requests\API\UpdateOrderAPIRequest;
use App\Models\CancelReason;
use App\Models\City;
use App\Models\CouponCode;
use App\Models\DeliveryCost;
use App\Models\Order;
use App\Models\UserWallet;
use App\Repositories\OrderRepository;
use App\User;
use function Helper\Common\__lang;
use function Helper\Common\base64ToImage;
use function Helper\Common\sendNoti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Validator;
/**
 * Class OrderController
 * @package App\Http\Controllers\API
 */

class OrderAPIController extends ApiController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        parent::__construct();
        $this->orderRepository = $orderRepo;
    }


    public function calculateOrder(Request $request)
    {

        $rules = [
        'from_city' => 'required',
        'to_city' => 'required',
        'shippment_type' => 'required',
        'number_of_piece' => 'required',
        'delivery_date' => 'required'
     ];
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return $this->respondBadRequest($validator->errors()->toArray());
        }

        $fromCity = $request->from_city;
        $toCity = $request->to_city;
        $shipmentType = $request->shippment_type;
        $pieces = $request->number_of_piece;
        $deliveryDate = $request->delivery_date;
        $wieght = 0;
        $totalPrice = 0;
        $exepctedDeliveryDate = date("Y-m-d");
        /** check cities */
        if(City::find($fromCity) != null && City::find($toCity) != null){
            /** check delivery cost in admin */
            $deliveryCost = DeliveryCost::getCost($fromCity,$toCity);
            if($deliveryCost != null){
                if($request->weight != null){
                    $wieght = $request->weight;
                }elseif ($request->height != null){
                    $length = $request->length;
                    $height = $request->height;
                    $width = $request->width;
                    if($length < $this->config->max_length && $height < $this->config->max_height && $width < $this->config->max_width){
                        $wieght = ($length+$height+$width)/$this->config->dvided_ratio;
                        $wieght = (int) $wieght;
                    }else{
                        return $this->respondBadRequest(__lang("you_have_exceed_maximum_values"));
                    }
                }

                $totalPrice = $deliveryCost->price_for_first_kilos;
                if($wieght > $deliveryCost->number_of_first_kilos){
                    $diff = $wieght-$deliveryCost->number_of_first_kilos;
                    $totalPrice = $deliveryCost->price_for_first_kilos+$diff*$deliveryCost->price_per_kilo;
                }

                if(strtotime($deliveryDate) == strtotime(date("Y-m-d"))){
                    if($this->canDeliveryToday()){
                        $exepctedDeliveryDate = date("Y-m-d");
                    }else{
                        $exepctedDeliveryDate = date("Y-m-d",strtotime("+1 day",time()));
                    }
                }else{
                    $exepctedDeliveryDate = $deliveryDate;
                }
                $data["result"]["price"] = $totalPrice;
                $data["result"]["expected_delivery_date"] = $exepctedDeliveryDate;
                return $this->respondWithSuccess($data);

            }else{
                return $this->respondBadRequest();
            }
        }else{
            return $this->respondBadRequest();
        }
    }

    public function canDeliveryToday(){
        $hour = date("H");
        if($this->config->max_hour_ship < $hour){
            return false;
        }else{
            return true;
        }
    }


    /**
     * @param CreateOrderAPIRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOrderAPIRequest $request)
    {
        $fromCity = $request->from_city;
        $toCity = $request->to_city;
        $shipmentType = $request->shippment_type;
        $pieces = $request->number_of_piece;
        $deliveryDate = $request->delivery_date;
        $wieght = 0;
        $totalPrice = 0;
        $exepctedDeliveryDate = date("Y-m-d");

        $toUser = new User();
        /** chck shippment type */

        if(!isset(Order::$shippmentType[$request->shippment_type])){
            return $this->respondBadRequest(__lang("invalid_shipment_type"));
        }
        /** check to Client */
        if($request->to_client_id != null && User::find($request->to_client_id) == null){
            return $this->respondBadRequest(__lang("to_client_not_found"));
        }

        /** check to Client */
        if($request->to_mobile != null){
            $toUser = User::where("mobile",$request->to_mobile)->first();
            if($toUser == null){
                $toUser = new User();
            }
        }

        /** check cities */
        if(City::find($fromCity) == null || City::find($toCity) == null){
            return $this->respondBadRequest();
        }
        /** check delivery cost in admin */
        $deliveryCost = DeliveryCost::getCost($fromCity,$toCity);
        if($deliveryCost == null) {
            return $this->respondBadRequest(__lang("delivery_cost_not_found_please_try_again"));
        }

        if($request->weight != null){
            $wieght = $request->weight;
        }elseif ($request->height != null){
            $length = $request->length;
            $height = $request->height;
            $width = $request->width;
            if($length < $this->config->max_length && $height < $this->config->max_height && $width < $this->config->max_width){
                $wieght = ($length+$height+$width)/$this->config->dvided_ratio;
                $wieght = (int) $wieght;
            }else{
                return $this->respondBadRequest(__lang("you_have_exceed_maximum_values"));
            }
        }

        $totalPrice = $deliveryCost->price_for_first_kilos;
        if($wieght > $deliveryCost->number_of_first_kilos){
            $diff = $wieght-$deliveryCost->number_of_first_kilos;
            $totalPrice = $deliveryCost->price_for_first_kilos+$diff*$deliveryCost->price_per_kilo;
        }

        //** check coupon code */
        $discount = 0;
        if($request->coupon_code != null){
            $code = CouponCode::where("code",$request->coupon_code)->where("expire_date",">",time())->first();
            if($code != null){
                $discount = ($totalPrice / 100 ) * $code->discount;
                $totalPrice -= $discount;
            }
        }
        if(strtotime($deliveryDate) == strtotime(date("Y-m-d"))){
            if($this->canDeliveryToday()){
                $exepctedDeliveryDate = date("Y-m-d");
            }else{
                $exepctedDeliveryDate = date("Y-m-d",strtotime("+1 day",time()));
            }
        }else{
            $exepctedDeliveryDate = $deliveryDate;
        }

        /* calculate commission */
        $commission = 0;
        if($request->cash_collected != null){
            $amount = $request->cash_collected_amount;
            $commission = ($amount / 100 ) * $this->config->collected_commission;
            if($commission < 10 ){
                $commission = 10;
            }
            $totalPrice += $commission;
        }

        $input = $request->all();
        $input["from_client_id"]  = $this->user->id;
        $input["status"] = 0;
        $input["number_of_piece"] = $pieces;
        $input["number_of_kilo"] = $wieght;
        $input['price'] = $totalPrice;
        $input["discount"] = $discount;
        $input["collected_commission"] = $commission;
        $input['delivery_date'] = $deliveryDate;
        $input["estimate_delivery_date"] = $exepctedDeliveryDate;
        $input["shippment_type"] = Order::$shippmentType[$request->shippment_type];
        $input['to_client_id'] = $toUser->id;
        /* create unique id */
        $maxID =  Order::max("id");
        if($maxID != null){
            $maxID = $maxID+1;
            $input["uniqueID"] = Order::$uniqueCode.$maxID;
        }else{
            $input["uniqueID"] = Order::$uniqueCode."1";
        }



        /** @var Order $order */
        $order = $this->orderRepository->create($input);
        return $this->respondWithSuccess($order->transform());
    }


    public function cancelOrder($id,Request $request)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        $reason = CancelReason::find($request->reason_id);
        if (empty($order) || empty($reason)) {
            return $this->respondBadRequest('Order not found');
        }

        if($order->from_client_id != $this->user->id){
            return $this->respondBadRequest();
        }

        DB::beginTransaction();
        try{
            if($order->status > Order::$statuses['canceled']) {
                /** @var User $client */
                $client =  $order->fromClient;
                if($client != null){
                    $client->wallet += $this->config->cancelation_cost;
                    $client->save();

                    // create wallet message
                    $wallet = new UserWallet();
                    $wallet->user_id = $client->id;
                    $wallet->message = __lang("cancel_order_no").".#".$order->uniqueID;
                    $wallet->cost = $this->config->cancelation_cost;
                    $wallet->type_of_cost = UserWallet::$costs["to_admin"];
                    $wallet->save();

                    //
                }
            }
            $order->status = Order::$statuses["canceled"];
            $order->cancel_reason_id = $reason->id;
            $order->save();

            DB::commit();

            /** send notification */
            if($order->status > Order::$statuses['canceled']) {
                /** @var User $delivery */
                $delivery =  $order->delivery;
                if($delivery != null){
                    $extras["type"] = 1;
                    $extras["result"] = $order->transform();
                    sendNoti($delivery->device_token , __lang("the_client_has_canceled_the_order"),null , $delivery->device_type);
                }
            }

            return $this->respondWithSuccess(__lang("success_cancellation"));
        }catch (\Exception $e){
            return $this->respondBadRequest($e->getMessage());
        }

    }

    public function rateOrder($id,Request $request)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order) || empty($request->rate)) {
            return $this->respondBadRequest('Order not found');
        }

        if($order->from_client_id != $this->user->id){
            return $this->respondBadRequest();
        }

        $order->rate = $request->rate;
        $order->comment = $request->comment;
        $order->save();
        return $this->respondWithSuccess(__lang("rated_success"));
    }

    public function changeStatus($id,Request $request)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        $status = $request->status;
        if (empty($order) || empty($status) || !isset(Order::$statuses[$status])) {
            return $this->respondBadRequest('Order not found');
        }

        if($status == "item_collected"){
            if($request->shippment_img == null){
                return $this->respondBadRequest(__lang("please_attach_the_picture_of_shipment"));
            }
            $order->shippment_img = base64ToImage($request->shippment_img);
        }
        if($status == "cash_collected" && !$order->cash_collected){
            return $this->respondBadRequest(__lang("this_order_haven't_cash_collection_returned"));
        }
        if($status == "delivered" ){
            $this->user->delivery_collected += $order->price;
            $this->user->save();
        }
        $order->status = Order::$statuses[$status];
        $order->save();

        /** send notification */
        /** @var User $client */
        $client = $order->fromClient;
        if($client != null){
            $message = "";
            if($status == "on_way_to_shipper"){
                $message = __lang("the_order_no").$order->uniqueID." ".__lang("is_now_on_way_to_shipper");
            }else if ($status == "item_collected"){
                $message = __lang("the_order_no").$order->uniqueID." ".__lang("is_now_collected");
            }else if ($status == "on_way_to_customer"){
                $message = __lang("the_order_no").$order->uniqueID." ".__lang("is_now_on_way_to_customer");
            }else if ($status == "cash_collected") {
                $message = __lang("the_order_no").$order->uniqueID." ".__lang("is_now_in_cash_collection");
            }else if($status == "delivered"){
                $message = __lang("the_order_no").$order->uniqueID." ".__lang("is_now_delivered");
            }
            $extras["type"] = 1;
            $extras["result"] = $order->transform();
            sendNoti($client->device_token , $message ,null , $client->device_type,$extras);
        }

        return $this->respondWithSuccess(__lang("changed_success"));
    }

    public function show($id,Request $request)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->respondWithError('Order not found');
        }

        $order = $order->transform();

        return $this->respondWithSuccess($order);
    }

    /**
     * Update the specified Order in storage.
     * PUT/PATCH /orders/{id}
     *
     * @param  int $id
     * @param UpdateOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        $order = $this->orderRepository->update($input, $id);

        return $this->sendResponse($order->toArray(), 'Order updated successfully');
    }

    /**
     * Remove the specified Order from storage.
     * DELETE /orders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->respondWithError('Order not found');
        }

        $order->delete();

        $data['message'] ="Order deleted successfully";
        return $this->respondWithSuccess($data);
    }
}
