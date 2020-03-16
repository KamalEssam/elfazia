<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\point;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class pointController extends Controller
{
    public function getInfoPage($id, Request $request)
    {
        $user = User::with('points')->where('id', $id)->get();
        $pointData = point::where('user_id', $id)->get();
        return view('info_page.index', compact('user', 'pointData'));

    }

    public function chargePoint($id, Request $request)
    {
        $user = User::where('user_id', $id)->get();
        dd($user);
    }

    public function addStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'center_id' => 'required|integer',
            'level_id' => 'required|integer',
            'group_id' => 'required|integer',
        ]);
        $std = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'role' => User::$roles["student"],
            'password' => bcrypt($request['password']),
        ]);
        if ($std) {
            $numberofpoints = point::where('user_id', auth()->user()->id)->pluck('number_of_points');
            $numberofStudent = point::where('user_id', auth()->user()->id)->pluck('number_of_students');
            $points = DB::table('points')
                ->where('user_id', auth()->user()->id)
                ->update(['number_of_points' => $numberofpoints[0] - 50]);
            $students = DB::table('points')
                ->where('user_id', auth()->user()->id)
                ->update(['number_of_students' => $numberofStudent[0] - 1]);
        }
        $student = new Student();
        $student->user_id = $std->id ;
        $student->center_id = $request["center_id"];
        $student->level_id = $request["level_id"];
        $student->group_id = $request["group_id"];
        $student->save();
        Flash::success('تم اضافه طالب جديد');
        return redirect()->back();
    }

//    public function chargeCard(Request $request)
//    {
//        $validator=Validator::make($request->all(),[
//            'charge_card'=>'required|max:10|min:10'
//        ]);
//        if ($validator->fails()){
//            return redirect()->back()->withErrors($validator->fails());
//        }
//        dd(substr($request['charge_card'],0,2));
//    }

    public function getcardGenerator(Request $request){
        return view('charge_card_page.index');
    }
    public function test(){
        dd('test');
    }
    public function postcardGenerator(Request $request){
        dd('sddx');
        $validator=Validator::make($request->all(),[
            'card_value'=>'required'
        ]);
        if ($validator->fails()){
            dd();
            return redirect()->back()->withErrors($validator->fails());
        }
        $cardNumber=random_int(10,11);
        dd($cardNumber);
        Flash::success('تم استخراج كارت نقاط جديد');

        return view('charge_card_page.index',compact('cardNumber'));

    }
}
