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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;

trait LoginTrait
{

    private $rules = array(
        'username' => 'required',
        'password' => 'required',
        'device_token' => 'required',
        'device_type' => 'required',
    );

    private $credentials = [];


    public function login(Request $request) {
        $role = 2;
        $api = new Api();

        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails())
        {
            return $api->respondBadRequest($validator->errors()->toArray());
        }
        else
        {
            $this->setCredentials($request , $role);
            /** @var User $user */
            if ($user = $this->authCheck()) {

                $user->device_token = $request->device_token;
                $user->device_type = $request->device_type;
                $user->save();

                return $this->respondToken($api , $user , $this->fireToken($user->email , $request->password));
            }
            else
            {
                return $api->respondBadRequest(__lang('invalid_credentials'));
            }

        }
    }


    private function setCredentials(Request $request,$role = 2)
    {
        $this->credentials['password'] = $request->input("password");
        $credentials['role'] = $role;
        $credentials['active'] = 1;
        if ($this->checkIFEmail($request->only('username')))
        {
            /** @var array $credentials */
            $this->credentials['email'] = $request->input("username");
        }
        else
        {
            $this->credentials['username'] = $request->input("username");
        }
    }

    private function checkIFEmail($request) {
        $validator = Validator::make($request, ['username' => 'email']);
        if ($validator->fails()) {
            return false;
        }
        return true;
    }

    private function authCheck() {

        $where_array = array();
        foreach ($this->credentials as $key => $value) {
            if ($key == 'password') {
                continue;
            }
            $where_array[] = array($key, '=', $value);
        }
        $find = User::where($where_array)->first();
        if ($find != null) {
            if (password_verify($this->credentials['password'], $find->password)) {
                return $find;
            }
        }
        return false;
    }

    public function logout()
    {
        $api = new Api();

        if($api->auth)
        {
            $api->user->device_token = "";
            $api->user->save();
            return $api->respondWithSuccess();

        }

    }

    public static function routesLogin()
    {
        // Login Routes...
        Route::post('login', 'UserController@login');
        Route::get('logout', 'UserController@logout');
    }
}