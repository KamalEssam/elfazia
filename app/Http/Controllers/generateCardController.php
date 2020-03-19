<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class generateCardController extends Controller
{
    public function getcardGenerator(Request $request){
        return view('charge_card_page.index');
    }

        public function chargeCard(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'charge_card'=>'required|max:10|min:9'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->fails());
        }
        if (strlen($request['charge_card']) == 10){

            $number=substr($request['charge_card'],0,4);
            $id=point::where('user_id',auth()->user()->id)->pluck('id');
            $std=point::find($id);

            $points = DB::table('points')
                ->where('user_id', auth()->user()->id)
                ->update(['number_of_points' =>  $std[0]->number_of_points + $number]);
            Flash::success('تم الشحن');
        }elseif (strlen($request['charge_card']) == 9){
            $number=substr($request['charge_card'],0,3);
            $id=point::where('user_id',auth()->user()->id)->pluck('id');
            $std=point::find($id);

            $points = DB::table('points')
                ->where('user_id', auth()->user()->id)
                ->update(['number_of_points' =>  $std[0]->number_of_points + $number]);
            Flash::success('تم الشحن');
        }else if (strlen($request['charge_card']) <9){
            Flash::Error('رقم الكارت خطاء');
        }
return redirect()->back();
    }

    public function postcardGenerator(Request $request){
        $validator=Validator::make($request->all(),[
            'card_value'=>'required'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->fails());
        }
        $cardNumber=$request['card_value'].random_int(100000,999999);
        Flash::success('تم استخراج كارت نقاط جديد');
        return view('home',compact('cardNumber'));

    }
}
