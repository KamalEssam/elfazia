<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 06/02/2018
 * Time: 03:35 م
 */

namespace App\Traits\Api;

use App\Http\Controllers\API\ApiController as Api;
use App\Models\Mall;
use App\User;
use function Helper\Common\__lang;
use function Helper\Common\base64ToFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Mockery\Exception;
use Validator;

trait RegisterTrait
{

    private $rulesRegister = array(
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'mobile' => 'required|unique:users',
        'password' => 'required',
        'device_token' => 'required',
        'device_type' => 'required',
        "username" => "required",
    );


    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    protected function register(Request $request) {

        $api = new Api();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($request->all(), $this->rulesRegister);
        if ($validator->fails())
        {
            return $api->respondBadRequest($validator->errors()->toArray());
        }
        else
        {
            try {

                $user = $this->storeUser($request);
                if($user == null)
                {
                    return $api->respondBadRequest();
                }

                return $this->respondToken($api , $user , $this->fireToken($user->email , $request->password));

            } catch (\Exception $e) {
                throw new Exception( $e->getMessage(),400);
            }
        }

    }


    /**
     * @param Request $request
     * @return User
     */
    private function storeUser(Request $request) {

        try{

            $user = new User();
            $user->mobile = $request->input('mobile');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->username = $request->input("username");
            $user->device_token = $request->input('device_token');
            $user->device_type = $request->input('device_type');

            //$nameSlug = "name_".$request->lang;
            // $user->role = 3;
            $user->active = 1;
            //$user->points = 0;
            //$user->last_update_points = "";
            //set img
            if($request->image)
            {
                $user->image = base64ToFile($request->image);
            }
            $user->save();
            return $user;

        }catch (Exception $e){
            throw new Exception(__lang("service_error"),400);
        }

    }




    public static function routesRegister()
    {
        // Register Routes...
        Route::post('register', 'UserController@register');
    }
}