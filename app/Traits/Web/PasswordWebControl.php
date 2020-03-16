<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 06/02/2018
 * Time: 03:35 م
 */

namespace App\Traits\Api;

use App\User;
use function Helper\Common\__lang;
use function Helper\Common\sendMail;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use Flash;
trait PasswordWebControl
{

    private $verify_rules = array(
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'password_confirmation' => 'required|same:password',
    );
    private $view_rules = array(
        'token' => 'required',
        'email' => 'required|email',
    );

    private $reset_rules = array(
        'email' => 'required|email',
//        'type' => 'required'
    );

    public function reserView() {
        return view("vendor.passwords.resetFormMail");
    }
    public function reset(Request $request) {

        $validator = Validator::make($request->all(), $this->reset_rules);
        if ($validator->fails()) {
            return view("vendor.passwords.resetFormMail")->with($validator->errors()->all());
        } else {
            $user = User::where('email', $request->input('email'))
                ->first();

            if ($user == null) {
                Flash::success( __lang("invalid_email"));
                return view("vendor.passwords.resetFormMail");

            } else {
                $user->remember_token = rand(1000000,9999999);
                $user->save();
                sendMail("vendor.passwords.mailPublic","vendor.passwords.resetMail",$user);
                ///
                Flash::success( __lang("password_reset_success"));
                return view("vendor.passwords.resetFormMail");

            }
        }
    }

    public function resetNextView(Request $request) {
        $validator = Validator::make($request->all(), $this->view_rules);
        if ($validator->fails()) {
            return redirect("password/reset");
        }
        return view("vendor.passwords.reset")->with("token",$request->token)->with("email",$request->email);
    }


    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), $this->verify_rules);
        if ($validator->fails()) {
            return view("vendor.passwords.reset")->with($validator->errors()->all())->with("token",$request->token)->with("email",$request->email);
        } else {
            $user = User::where('email', $request->input('email'))->first();
            if ($user == null) {
                Flash::error("email not found");
                return view("vendor.passwords.reset")->with("token",$request->token)->with("email",$request->email);
            } else {
                if ($request->input('token') != $user->remember_token) {

                    Flash::error("the code is expire");
                    return view("vendor.passwords.reset")->with("token",$request->token)->with("email",$request->email);
                }
                //Mail::to('')->send(new ResetPasswordMail());
                try {

                    //dd('here');
                    $user->password = bcrypt($request->input('password'));
                    $user->remember_token = 0;
                    $user->save();
                    Flash::success("password reset successfully");
                    return view("password.reset")->with("token",$request->token)->with("email",$request->email);
                } catch (Exception $ex) {
                    Flash::success($ex->getMessage());
                    return view("vendor.passwords.reset")->with("token",$request->token)->with("email",$request->email);
                }
            }
        }
    }

    public static function routesPassword()
    {

        // Password Reset Routes...
        Route::get('password/reset', 'UserController@resetView');
        Route::post('password/reset/first', 'UserController@reset');
        Route::get('password/reset/view', 'UserController@resetNextView');
        Route::post('password/reset/confirm', 'UserController@resetPassword');

    }
}