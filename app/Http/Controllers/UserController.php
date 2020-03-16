<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserWallet;
use App\User;
use function Helper\Common\__lang;
use function Helper\Common\imageUrl;
use function Helper\Common\sendMail;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Response;
use DataTables;
use Validator;
class UserController extends AppBaseController
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
        return view('users.index');
    }


    public function edit($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    public function update($id, Request $request)
    {


        $user = User::find($id);

        if (empty($user)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('users.index'));
        }


        $input = $request->request->all();

        // create wallet message
        $wallet = new UserWallet();
        $wallet->user_id = $id;
        $wallet->cost = $request->cost;
        $wallet->type_of_cost = $request->type_of_cost;
        if($request->type_of_cost == 1){
            $wallet->message = __lang("decrease_your_wallet_by")." ".$wallet->cost;
        }else{
            $wallet->message = __lang("recharge_your_wallet_by")." ".$wallet->cost;
        }
        $wallet->save();

        //

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('users.index'));
    }


    public function active($id,Request $request)
    {
        $user = User::find($id);
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

    public function resetWallet($id,Request $request)
    {
        $user = User::find($id);
        if (empty($user)) {
            $data['success'] = false;
            $data['message'] = __lang("error_no_data");
            return $data;
        }
        $user->wallet = 0;
        $user->save();
        $user->wallets()->delete();


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
                User::find($id)->delete();
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
        $items = User::where("role",User::$roles["client"])->select();


        return DataTables::eloquent($items)
            ->addColumn('options', function (User $item) {
                $back = ' <div class="btn-group">';
                $back .= '
                        <a href="'. route('users.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                return $back;
            })

            ->addColumn("active",function(User $item){
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
            ->addColumn("reset_wallet",function(User $item){
                if($item->wallet > 0){
                    $item->wallet = -$item->wallet;
                }
                $back = '<a class="btn btn-warning" onclick="resetWallet(this)" data-id="'.$item->id.'">';
                $back.= "اعادة تهيئة المحفطة"." " ."</a>";
                return $back;
            })
            ->editColumn('image', function (User $item) {
                $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';

                return $back;
            })
            ->editColumn('wallet', function (User $item) {
                $toAdmin = $item->wallets()->where("type_of_cost",UserWallet::$costs["to_admin"])->sum("cost");
                $toClient = $item->wallets()->where("type_of_cost",UserWallet::$costs["to_client"])->sum("cost");
                $back = $toClient - $toAdmin;
                return $back;
            })
            ->editColumn('orders', function (User $item) {
                $back = '<a class="btn btn-info" href="'.route("orders.index").'?user_id='.$item->id.'">';
                $back.= "الطلبات"."</a>";
                return $back;
            })
//            ->editColumn('order_numbers', function (User $item) {
//                $back = $item->orders()->count();
//                return $back;
//            })

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
    public function addUser(Request $request){
        $validator= \Illuminate\Support\Facades\Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'mobile'=>'required',
            'role'=>'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $user=User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>bcrypt($request['password']),
            'mobile'=>$request['mobile'],
            'role'=>$request['role'],
        ]);
        Flash::success('تم اضافه العضو بنجاح');

        return redirect()->back();
    }
}
