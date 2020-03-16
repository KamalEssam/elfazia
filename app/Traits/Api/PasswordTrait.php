<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 06/02/2018
 * Time: 03:35 م
 */

namespace App\Traits\Api;

use App\Http\Controllers\API\ApiController as Api;
use App\User;
use function Helper\Common\__lang;
use function Helper\Common\sendMail;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;

trait PasswordTrait
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

    public function reset(Request $request) {

        $api = new Api();
        $validator = Validator::make($request->all(), $this->reset_rules);
        if ($validator->fails()) {
            return $api->respondBadRequest($validator->errors()->toArray());
        } else {
            $user = User::where('email', $request->input('email'))
                ->first();

            if ($user == null) {
                $message = __lang('invalid_email');
                return $api->respondBadRequest($message);
            } else {
                //Mail::to('')->send(new ResetPasswordMail());
                $user->remember_token = rand(1000000,9999999);
                $user->save();
                sendMail("vendor.passwords.mailPublic","vendor.passwords.resetMail",$user);
                ///
                /// display json
                $data = array();
                $data['message'] = __lang("password_reset_success");
                return $api->respondWithSuccess($data);
            }
        }
    }


    public function verify(Request $request) {
        $api = new Api();
        $validator = Validator::make($request->all(), $this->verify_rules);
        if ($validator->fails()) {
            return $api->respondBadRequest($validator->errors()->toArray());

        } else {
            $user = User::where('email', $request->input('email'))->first();
            if ($user == null) {
                return $api->respondBadRequest(__lang('app.invalid_email'));
            } else {
                if ($request->input('token') != $user->remember_token) {

                    return $api->respondBadRequest(__lang("invalid_verification_code"));
                }
                //Mail::to('')->send(new ResetPasswordMail());
                try {
                    //dd('here');
                    $user->password = bcrypt($request->input('password'));
                    $user->remember_token = null;
                    $user->save();
                    $data['message'] = __lang("updated_successfully");
                    return $api->respondWithSuccess($data);
                } catch (Exception $e) {
                    //dd('here');
                    return $api->respondBadRequest($e->getMessage());
                }
            }
        }
    }

    public static function routesPassword()
    {

        // Password Reset Routes...
        Route::post('password/reset', 'UserController@reset');
        Route::post('password/verify', 'UserController@verify');

    }
}