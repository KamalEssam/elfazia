<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateOrderRequest;
use App\Models\CancelReason;
use App\Models\City;
use App\Models\DeliveryCost;
use App\Models\Order;
use App\Traits\Api\PasswordWebControl;
use App\User;
use function Helper\Common\__address;
use function Helper\Common\__lang;
use function Helper\Common\sendMail;
use function Helper\Common\titleSlug;
use function Helper\Common\upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mockery\Exception;

use Validator;
use Flash;

class WebController extends AppFrontController
{
    use PasswordWebControl;

    //
    public $activePage = false;
    public function __construct()
    {
        parent::__construct();

        $this->middleware("authWeb")->except([
            "index",
            "about",
            "application",
            "contacts",
            "contactSave",
            "loginForm",
            "register",
            "registerForm",
            "trackOrder",
            "estimateOrder"]);

    }
    public function changeLang($lang){
        Session::put("lang",$lang);
        $this->lang = $lang;
        Session::save();
        return redirect("");
    }

    public function index()
    {
        $this->page_title = __lang("kanza_group");
        $this_page = "index";
        return view('web.index')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }

    public function about(){

        $this->page_title = __lang("about_kanza");
        return view('web.about')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }
    public function application(){

        $this->page_title = __lang("application");
        return view('web.application')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }

    public function contacts(){

        $this->page_title = __lang("contact_us");
        return view('web.contactus')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }


    public function contactSave(Request $request){
//
//        $input = $request->all();
//        if($request->hasFile("image"))
//        {
//            $input['image'] = $this->uploadFile($request,"image",false);
//        }
//
//
//        $complain = Complain::create($input);



        $complain= new \stdClass();
        $complain->username = $request->name;
        $complain->body = $request->message;
        $complain->subject = "complain";
        ///////
        sendMail("emails.mailPublic","simple",$complain,"New message","mr.ahmed@stop-group.com");
        ////////
        ///
        \request()->session()->put("flash",__lang("the_message_has_send_successfully"));
        if(Str::contains(redirect()->back()->getTargetUrl(),"contact")){
            return redirect("contact");
        }
        return redirect("");
    }


    public function loginForm(Request $request)
    {
        //
        $this->page_title = __lang("login");
        return view('web.login')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }
    public function logout(Request $request)
    {
        $this->user = null;
        $this->auth = false;
        Auth::logout();
        return redirect("home");
    }
    public function registerForm(){
        return view('web.register')
            ->with("flag","login")
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }
    public function register(Request $request)
    {
        $rules = [
            "name"=> "required",
            "email"=> "required|email|unique:users",
            "password"=> "required",
            "mobile"=> "required|unique:users",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return view('web.register')
            ->with("page_title",$this->page_title)
                ->with("flag","register")
            ->with("public_data",$this->publicData)->withErrors($validator->errors()->toArray());
        }

        DB::beginTransaction();
        try{
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $input['role'] = User::$roles["client"];
            $input['active'] = 1;
            $input['image'] = "/public/uploads/no_avatar.jpg";
            $maxID =  User::max("id");
            if($maxID != null){
                $maxID = $maxID+1;
                $input['uniqueID'] = User::$uniqueCode.$maxID;
            }else{
                $input['uniqueID'] = User::$uniqueCode."1";
            }

            $user = User::create($input);
            DB::commit();

        }catch (Exception $e){
            DB::rollback();
        }
        //
        $this->page_title = __lang("register");
        \request()->session()->put("flash",__lang("register_done"));
        return redirect('login')
            ->with("flag","login")
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }

    public function account(Request $request)
    {
        //



        $inGoing = $this->user->inGoingOrders()->get();
        $outGoing = $this->user->userOrders()->get();
        $collection = $inGoing->merge($outGoing);

        $this->page_title = __lang("profile");
        return view('web.profile')
            ->with("page_title",$this->page_title)
            ->with("orders",$collection)
            ->with("public_data",$this->publicData);
    }
    public function accountEdit(Request $request)
    {
        //

        $user = User::transform($this->user);
        $this->page_title = __lang("profile");
        return view('web.account_edit')
            ->with("page_title",$this->page_title)
            ->with("user",$user)
            ->with("public_data",$this->publicData);
    }


    public function accountUpdate(Request $request)
    {
        $user = User::transform($this->user);
        $this->page_title = __lang("profile");
        //

        if($this->auth){

            $rules = [
                "name"=> "required",
                "email"=> "required|email|unique:users,email,".$this->user->id,
                "mobile"=> "required|unique:users,mobile,".$this->user->id,
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return view('web.account_edit')
                    ->with("user",$user)
                    ->with("page_title",$this->page_title)
                    ->with("public_data",$this->publicData)->withErrors($validator->errors()->toArray());
            }

            $this->user->email = $request->email;
            $this->user->mobile = $request->email;
            $this->user->name = $request->name;
            //password verfiy
            if($request->old_password != null){
                if(password_verify($request->old_password,$this->user->password)){
                    $this->user->password = bcrypt($request->password);
                }else{
                    Flash::error(__lang("old_password_wrong"));
                    return view('web.account_edit')
                        ->with("type",$request->type)
                        ->with("user",$user)
                        ->with("page_title",$this->page_title)
                        ->with("public_data",$this->publicData);
                }
            }
            //

            $this->user->save();

        }
        //$store = User::transform($this->user);
        $this->page_title = __lang("profile");
        return redirect("account");
    }

    public function cancelOrder($id,Request $request)
    {
        /** @var Order $order */
        $order = Order::find($id);

        if (empty($order)) {
            return redirect("account");
        }

        if($order->from_client_id != $this->user->id){
            return redirect("account");
        }
        $order->status = Order::$statuses["canceled"];
        $order->save();


        \request()->session()->put("flash",__lang("cancel_successful"));
        return redirect("account");

    }



    public function estimateOrder(Request $request){

        $cities = City::transformAll();

        $total = 0;
        if($request->from_city != null){
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
                return view('web.estimate')
                    ->with("page_title",$this->page_title)
                    ->with("cities",$cities)
                    ->with("public_data",$this->publicData)->withErrors($validator->errors()->toArray());
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
            if(City::find($fromCity) != null && City::find($toCity) != null) {
                /** check delivery cost in admin */
                $deliveryCost = DeliveryCost::getCost($fromCity, $toCity);
                if ($deliveryCost != null) {
                    if ($request->weight != null) {
                        $wieght = $request->weight;
                    } elseif ($request->height != null) {
                        $length = $request->length;
                        $height = $request->height;
                        $width = $request->width;
                        if ($length < $this->config->max_length && $height < $this->config->max_height && $width < $this->config->max_width) {
                            $wieght = ($length + $height + $width) / $this->config->dvided_ratio;
                            $wieght = (int)$wieght;
                        } else {

                            \request()->session()->put("flash", __lang("you_have_exceed_maximum_values"));
                            return view('web.estimate')
                                ->with("page_title",$this->page_title)
                                ->with("cities",$cities)
                                ->with("total",$total)
                                ->with("public_data",$this->publicData);
                        }
                    }

                    $totalPrice = $deliveryCost->price_for_first_kilos;
                    if ($wieght > $deliveryCost->number_of_first_kilos) {
                        $diff = $wieght - $deliveryCost->number_of_first_kilos;
                        $totalPrice = $deliveryCost->price_for_first_kilos + $diff * $deliveryCost->price_per_kilo;
                    }

                    if (strtotime($deliveryDate) == strtotime(date("Y-m-d"))) {
                        if ($this->canDeliveryToday()) {
                            $exepctedDeliveryDate = date("Y-m-d");
                        } else {
                            $exepctedDeliveryDate = date("Y-m-d", strtotime("+1 day", time()));
                        }
                    } else {
                        $exepctedDeliveryDate = $deliveryDate;
                    }
                    $data["result"]["price"] = $totalPrice;
                    $data["result"]["expected_delivery_date"] = $exepctedDeliveryDate;
                    $total = $totalPrice;

                } else {
                    \request()->session()->put("flash", __lang("sorry_not_found_cost_now_try_again"));
                    return view('web.estimate')
                        ->with("page_title",$this->page_title)
                        ->with("cities",$cities)
                        ->with("total",$total)
                        ->with("public_data",$this->publicData);
                }
            }
        }
        return view('web.estimate')
            ->with("page_title",$this->page_title)
            ->with("cities",$cities)
            ->with("total",$total)
            ->with("public_data",$this->publicData);
    }



    public function canDeliveryToday(){
        $hour = date("H");
        if($this->config->max_hour_ship < $hour){
            return false;
        }else{
            return true;
        }
    }


    public function trackOrder(Request $request)
    {
        if($request->ship != null){
            /** @var Order $order */
            $order = Order::where("uniqueID",$request->ship)->first();

            if (empty($order)) {
                \request()->session()->put("flash",__lang("not_found"));
                return redirect("track/order");
            }else{

                $status = __lang(Order::$statusesText[$order->status]);
                return view('web.track')
                    ->with("page_title",$this->page_title)
                    ->with("status",$status)
                    ->with("public_data",$this->publicData);
            }



        }else{
            return view('web.track')
                ->with("page_title",$this->page_title)
                ->with("public_data",$this->publicData);
        }



    }

    public function requestOrder(Request $request)
    {
        $cities = City::transformAll();
        return view('web.make_order')
            ->with("page_title",$this->page_title)
            ->with("cities",$cities)
            ->with("public_data",$this->publicData);



    }

    public function makeOrder(CreateOrderRequest $request)
    {
        $cities = City::transformAll();

        $fromCity = $request->from_city;
        $toCity = $request->to_city;
        $shipmentType = $request->shippment_type;
        $pieces = $request->number_of_piece;
        $deliveryDate = $request->delivery_date;
        $wieght = 0;
        $totalPrice = 0;
        $exepctedDeliveryDate = date("Y-m-d");

        /** chck shippment type */

        if(!isset(Order::$shippmentType[$request->shippment_type])){
            \request()->session()->put("flash",__lang("invalid_shipment_type"));
            return view('web.make_order')
                ->with("page_title",$this->page_title)
                ->with("cities",$cities)
                ->with("public_data",$this->publicData);

        }
        /** check to Client */
        if($request->to_client_id != null && User::find($request->to_client_id) == null){
            \request()->session()->put("flash",__lang("to_client_not_found"));
            return view('web.make_order')
                ->with("page_title",$this->page_title)
                ->with("cities",$cities)
                ->with("public_data",$this->publicData);

        }
        /** check cities */
        if(City::find($fromCity) == null || City::find($toCity) == null){
            \request()->session()->put("flash",__lang("not_found"));
            return view('web.make_order')
                ->with("page_title",$this->page_title)
                ->with("cities",$cities)
                ->with("public_data",$this->publicData);
        }
        /** check delivery cost in admin */
        $deliveryCost = DeliveryCost::getCost($fromCity,$toCity);
        if($deliveryCost == null) {
            \request()->session()->put("flash",__lang("delivery_cost_not_found_please_try_again"));
            return view('web.make_order')
                ->with("page_title",$this->page_title)
                ->with("cities",$cities)
                ->with("public_data",$this->publicData);

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
                \request()->session()->put("flash",__lang("you_have_exceed_maximum_values"));
                return view('web.make_order')
                    ->with("page_title",$this->page_title)
                    ->with("cities",$cities)
                    ->with("public_data",$this->publicData);

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

        $input = $request->all();
        $input["from_client_id"]  = $this->user->id;
        $input["status"] = 0;
        $input["number_of_piece"] = $pieces;
        $input["number_of_kilo"] = $wieght;
        $input['price'] = $totalPrice;
        $input["discount"] = 0;
        $input['delivery_date'] = $deliveryDate;
        $input["estimate_delivery_date"] = $exepctedDeliveryDate;
        $input["shippment_type"] = Order::$shippmentType[$request->shippment_type];

        /* create unique id */
        $maxID =  Order::max("id");
        if($maxID != null){
            $maxID = $maxID+1;
            $input["uniqueID"] = Order::$uniqueCode.$maxID;
        }else{
            $input["uniqueID"] = Order::$uniqueCode."1";
        }

        /** @var Order $order */
        $order = Order::create($input);

        \request()->session()->put("flash",__lang("order_send_successfully"));
        return view('web.make_order')
            ->with("page_title",$this->page_title)
            ->with("cities",$cities)
            ->with("order",$order)
            ->with("public_data",$this->publicData);


    }


    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function favorite($id)
    {
        if(!$this->auth){
            return redirect("login");
        }
        $productRepository = new Product();

        $product = $productRepository->find($id);
        if($product == null)
        {
            return $this->_404();
        }

        $checkfavorite = Favorite::where("user_id",$this->user->id)->where("product_id",$id)->first();
        if($checkfavorite == null){
            $input['product_id'] = $id;
            $input['user_id'] = $this->user->id;
            Favorite::create($input);
        }else{
            $checkfavorite->delete();
        }

        return redirect()->back();

    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function myFavorite()
    {

        $favorites = [];
        $products = Favorite::where("user_id",$this->user->id)->get();


        foreach ($products as $item){
            $favorites[] = Product::transform($item->product,$this->user->id);
        }


//        dd($favoritesStore);
        //$product = Product::transform($product);
        $this->page_title = __lang("favorites");
        return view('web.favorite')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData)
            ->with(compact("favorites"));
        //

    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function myCart()
    {
        $carts = [];
        $products = Cart::where("user_id",$this->user->id)->get();


        $counter = 0;
        foreach ($products as $item){
            $carts[$counter] = Product::transform($item->product,$this->user->id);
            $carts[$counter]->quantity = $item->quantity;
            $counter++;
        }


//        dd($favoritesStore);
        //$product = Product::transform($product);
        $this->page_title = __lang("cart");
        return view('web.cart')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData)
            ->with(compact("carts"));
        //

    }
    public function myOrders()
    {
        $orders = [];
        $data = $this->user->orders()->orderBy("status")->get();
        foreach ($data as $record){
            $orders[] = Order::transformSpecial($record);
        }

//        dd($favoritesStore);
        //$product = Product::transform($product);
        $this->page_title = __lang("my_orders");
        return view('web.myorder')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData)
            ->with(compact("orders"));
        //

    }


    /**
     * @param $id
     * @param CreateCartAPIRequest $request
     * @return mixed
     */
    public function cartSave($id,Request $request)
    {
        $product = Product::find($id);
        if($product == null)
        {
            return $this->_404();
        }

        if ($product->active == 0){
            \request()->session()->put("flash",__lang("this_product_is_inactive"));
            return redirect()->back();
        }
        /** @var Cart $cart */
        $cart = Cart::where("product_id",$id)->where("user_id",$this->user->id)->first();
        if($cart != null)
        {
            $cart->delete();
        }
        else
        {
            $input['product_id'] = $id;
            $input['user_id'] = $this->user->id;
            $input['quantity'] = 1;
            Cart::create($input);
        }
        return redirect()->back();
    }


    public function cartUpdate($product_id , $quantity)
    {
        $product = Product::find($product_id);
        if($product == null)
        {
            return "false";
        }

        /** @var Cart $cart */
        $cart = Cart::where("product_id",$product_id)->where("user_id",$this->user->id)->first();
        if($cart != null)
        {
            $cart->quantity = $quantity;
            $cart->save();
        }
        return "success";

    }


    public function cartDestroy()
    {
        $this->user->cart()->delete();
        return redirect()->back();
    }

    public function cityAjax($city_id)
    {
        return District::transformCollection(District::where("city_id",$city_id)->get());
    }


    public function orderCreate(Request $request)
    {
        if($this->user->cart->count() < 1)
        {
            \request()->session()->put("flash",__lang("please_put_any_product_to_your_cart"));
            return redirect("my/cart");
        }
        //
        $this->page_title = __lang("make_order");
        return view('web.order-form')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }
    /**
     * @param CreateOrderAPIRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function orderSave(CreateOrderRequest $request)
    {

        if($this->user->cart->count() < 1)
        {
            \request()->session()->put("flash",__lang("please_put_any_product_to_your_cart"));
            return redirect("order/create");
        }
        DB::beginTransaction();
        try{
            $input = $request->all();
            $input['status'] = 0;
            $input['location_ar'] = __address($input['lat'],$input['lng'],"AR");
            $input['location_en'] = __address($input['lat'],$input['lng'],"EN");
            $input['user_id'] = $this->user->id;

            //db connections
            /** @var Order $orders */
            $orders = Order::create($input);
            $orders->orderDetails()->createMany($this->user->cart->toArray());
            $this->user->cart()->delete();
            //end
            DB::commit();


            ///////
            sendMail("emails.mailPublic","new_order",$orders,"New order","sales@kanzagroup.com.eg");
            ////////
        }catch (Exception $e){
            DB::rollBack();
            \request()->session()->put("flash",$e->getMessage());
            return redirect("order/create");
        }

        return redirect("order/complete/$orders->id");
    }
    public function orderComplete($order_id)
    {
        //
        $this->page_title = __lang("order_complete");
        return view('web.order-complete')
            ->with("page_title",$this->page_title)
            ->with("order_number",$order_id)
            ->with("public_data",$this->publicData);
    }

    /**
     * @param $id
     * @param Request $request
     * @return $this
     */
    public function search(Request $request)
    {
        $builder = new Product();
        $search = $request->search;


        $titleSlug = "name_".$this->lang;
        $descriptionSlug = "description_".$this->lang;
        $products = $builder
            ->join("materials","materials.id","=","products.material_id")
            ->where("products.active",1)
            ->where("materials.$titleSlug",'like',"%$search%")
            ->orWhere("products.$titleSlug",'like',"%$search%")
            //->orWhere("products.$descriptionSlug",'like',"%$search%")
            ->select(["products.*"])
            ->distinct()
            ->paginate($this->limit);

        $products->appends("search",$search);

        for($i = 0; $i < count($products) ; $i++){
            $products[$i] = Product::transform($products[$i],$this->user->id);
        }
        $this->page_title = $request->search;
        return view('web.search_products')
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData)
            ->with(compact("categories","products"));
    }


}
