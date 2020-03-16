<?php
/**
 * Created by PhpStorm.
 * User: mada
 * Date: 22/01/18
 * Time: 02:01 ص
 */

namespace App\Http\Controllers\API;



use App\Traits\Api\LoginTrait;
use App\Traits\Api\PassportTrait;
use App\Traits\Api\PasswordTrait;
use App\Traits\Api\RegisterTrait;
use App\User;
use function Helper\Common\__lang;
use function Helper\Common\base64ToFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{

    use  PassportTrait , LoginTrait , RegisterTrait , PasswordTrait;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Activate the specified user.
     *
     * @param  int $id
     * @param  int $activeCode
     *
     * @return Response
     */
    public function activate($activeCode)
    {
        if(Auth::check())
        {
            $this->auth = true;
            $this->user = Auth::user();
        }


        if ($this->auth == false || empty($activeCode)) {
            return $this->respondBadRequest();
        }

        if($activeCode == $this->user->activation_code)
        {
            $this->user->activation_code =0;
            $this->user->active = 1;
            $this->user->save();

            $data['result'] = $data['result'] = User::transform($this->user) ;
            $data['message'] = __lang("your_account_has_been_activated");
            return $this->respondWithSuccess($data);
        }
        else
        {
            return $this->respondBadRequest(__lang("error_code"));
        }

    }

    protected function update(Request $request) {

        $rules = array();
        if ($request->input('name')) {
            $rules['name'] = "required";
        }
        if ($request->input('username')) {
            $rules['username'] = "required|unique:users,username,".$this->user->id;
        }
        if ($request->input('email')) {
            $rules['email'] = "required|email|unique:users,email,".$this->user->id;
        }
        if ($request->input('mobile')) {
            $rules['mobile'] = "required|unique:users,mobile,".$this->user->id;
        }
        if ($request->input('old_password')) {
            $rules['password'] = "required";
            //$rules['confirm_password'] = "required|same:password";
        }


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors()->toArray());
        } else {


            try {

                if ($request->input('name')) {
                    $this->user->name = $request->input('name');
                }
                if ($request->input('mobile')) {
                    $this->user->mobile = $request->input('mobile');
                }
                if ($request->input('username')) {
                    $this->user->username = $request->input('username');
                }
                if ($request->input('email')) {
                    $this->user->email = $request->input('email');
                }
                if ($old_password = $request->input('old_password')) {
                    if (!password_verify($old_password, $this->user->password)) {
                        return $this->respondBadRequest(__lang('app.invalid_old_password'));
                    } else {
                        $this->user->password = bcrypt($request->input('password'));
                    }
                }

                if ($request->input('image')) {
                    if (!is_dir($this->user->image)) {
                        if (file_exists($this->user->image)) {
                            unlink($this->user->image);
                        }
                    }

                    $this->user->image = base64ToFile($request->input('image'));
                }
                $this->user->save();

                $data['result'] = User::transform($this->user) ;
                return $this->respondWithSuccess($data);
            } catch (\Exception $e) {
                $message = __lang('app.error_is_occurred');
                return $this->respondBadRequest($message);
            }
        }
    }

}