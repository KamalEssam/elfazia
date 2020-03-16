<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeliveryRequest;
use App\Models\Attendance;
use App\Models\Delivery;
use App\User;
use function Helper\Common\__lang;
use function Helper\Common\imageUrl;
use Illuminate\Http\Request;
use Flash;
use Response;
use DataTables;
use Validator;
class DeliveryController extends AppBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the League.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('deliveries.index');
    }
    public function locations($id,Request $request)
    {
        $deliveries = User::where("id",$id)->select("lat","lng")->get();

        return $deliveries;
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */
    public function create()
    {
        return view('deliveries.create');
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliveryRequest $request)
    {


        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",false);
        $input['national_id_img'] = $this->uploadFile($request,"national_id_img",false);
        $input['driving_license_img'] = $this->uploadFile($request,"driving_license_img",true);
        $input['bike_license_img'] = $this->uploadFile($request,"bike_license_img",true);
        $input['check_details_img'] = $this->uploadFile($request,"check_details_img",true);
        $input['drugs_img'] = $this->uploadFile($request,"drugs_img",true);
        $input['role'] = Delivery::$roles["delivery"];
        $input['password'] = bcrypt($input['password']);
        $maxID =  User::max("id");
        if($maxID != null){
            $maxID = $maxID+1;
            $input["uniqueID"] = User::$uniqueCode.$maxID;
        }else{
            $input["uniqueID"] = User::$uniqueCode."1";
        }
        $user = Delivery::create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('deliveries.index'));
    }

    public function show($id)
    {
        $delivery = Delivery::find($id);

        if (empty($delivery)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('users.index'));
        }

        return view('deliveries.show')->with('delivery', $delivery);
    }

    public function edit($id)
    {
        $delivery = Delivery::find($id);

        if (empty($delivery)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('deliveries.index'));
        }
        $delivery->password = null;

        return view('deliveries.edit')->with('delivery', $delivery);
    }


    public function update($id, CreateDeliveryRequest $request)
    {

        $delivery = Delivery::find($id);

        if (empty($delivery)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('deliveries.index'));
        }

        $input = $request->request->all();

        if($request->hasFile("image"))
        {
            $input['image'] = $this->uploadFile($request,"image",false);
        }
        if($request->hasFile("national_id_img"))
        {
            $input['national_id_img'] = $this->uploadFile($request,"national_id_img",false);
        }
        if($request->hasFile("driving_license_img"))
        {
            $input['driving_license_img'] = $this->uploadFile($request,"driving_license_img",true);
        }
        if($request->hasFile("bike_license_img"))
        {
            $input['bike_license_img'] = $this->uploadFile($request,"bike_license_img",true);
        }
        if($request->hasFile("check_details_img"))
        {
            $input['check_details_img'] = $this->uploadFile($request,"check_details_img",true);
        }
        if($request->hasFile("drugs_img"))
        {
            $input['drugs_img'] = $this->uploadFile($request,"drugs_img",true);
        }

        if($request->password != null){

            $input["password"] = bcrypt($request->password);
        }else{
            unset($input['password']);
        }

        $delivery->update($input);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('deliveries.index'));
    }


    public function active($id,Request $request)
    {
        $user = Delivery::find($id);
        if (empty($user)) {
            $data['success'] = false;
            $data['message'] = __lang("error_no_data");
            return $data;
        }
        if($user->active == 1)
        {
            $user->active = 0;
            $user->save();
        }
        elseif($user->active == 0)
        {
            $user->active = 1;
            $user->save();

        }


        $data['message'] = 'تم حفظ البيانات بنجاح';
        $data['success'] = true;
        return $data;
    }
    public function attend($id,Request $request)
    {
        $user = Delivery::find($id);

        if (empty($user)) {
            $data['success'] = false;
            $data['message'] = __lang("error_no_data");
            return $data;
        }
        //check attend
        $attendance = $user->checkAttend();
        if($attendance != null){
            $attendance->user_id = $user->id;
            $attendance->attend_date = date("Y-m-d");
            $attendance->time_attend = date("H:i");
            $attendance->attend = true;
            $attendance->save();
        }else{
            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->attend_date = date("Y-m-d");
            $attendance->time_attend = date("H:i");
            $attendance->attend = true;
            $attendance->save();
        }
        $data['message'] = 'تم حفظ البيانات بنجاح';
        $data['success'] = true;
        return $data;
    }

    public function attendOut($id,Request $request)
    {
        $user = Delivery::find($id);

        if (empty($user)) {
            $data['success'] = false;
            $data['message'] = __lang("error_no_data");
            return $data;
        }
        //check attend
        $attendance = $user->checkAttend();
        if($attendance != null){
            $attendance->user_id = $user->id;
            $attendance->attend_date = date("Y-m-d");
            $attendance->time_out = date("H:i");
            $attendance->attend = true;
            $attendance->save();
        }else{
            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->attend_date = date("Y-m-d");
            $attendance->time_out = date("H:i");
            $attendance->attend = true;
            $attendance->save();
        }
        $data['message'] = 'تم حفظ البيانات بنجاح';
        $data['success'] = true;
        return $data;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function destroy(Request $request)
    {
        /*
         if($request->ids != null AND count($request->ids) > 0)
         {
             foreach ($request->ids as $id)
             {
                 $this->brandRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('brands.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('brands.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                Delivery::find($id)->delete();
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
        $items = Delivery::where("role",Delivery::$roles["delivery"])->select();


        return DataTables::eloquent($items)
            ->addColumn('options', function (Delivery $item) {
                $back = ' <div class="btn-group">';
                $back .= '
                        <a href="'. route('deliveries.show' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="'. route('deliveries.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                return $back;
            })

            ->addColumn("active",function(Delivery $item){
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

            ->editColumn('image', function (Delivery $item) {
                $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';

                return $back;
            })
            ->editColumn('orders', function (Delivery $item) {
                $back = '<a class="btn btn-info" href="'.route("orders.index").'?delivery_id='.$item->id.'">';
                $back.= "الطلبات"."</a>";
                return $back;
            })
            ->addColumn("attend",function(Delivery $item){
                $back = '<a class="btn btn-default" onclick="attend(this)" data-id="'.$item->id.'">';
                $back.= "حاضر"."</a>";

                return $back;
            })
            ->addColumn("attend_out",function(Delivery $item){
                $back = '<a class="btn btn-default" onclick="attendOut(this)" data-id="'.$item->id.'">';
                $back.= "انصراف"."</a>";
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
