<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ApiAccess;
use App\Models\Config;
use App\Traits\Api\RespondTrait;
use App\User;
use Illuminate\Support\Facades\Auth;


/**
 * Class ApiController
 */
class ApiController extends Controller {
    use RespondTrait;


    /** @var string $lang */
    protected $lang = "ar";
    /** @var int $limit */
    protected $limit = 10;

    /** @var User $user */
    public  $user = null;
    /** @var bool auth */
    public  $auth = false;

    /** @var  Config */
    protected $config;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->middleware("apiVersion");

        $this->langControl();
        $this->authUser();
        $this->setConfig();
        $this->readNotification();
        //$this->setApiKey();

    }

    /**
     * @return bool
     */
    public function checkVersion()
    {
        $version = request()->header("version");

        if($version == null)
        {
            return false;
        }
        elseif($version != null && $version != env("API_VERSION"))
        {
           return false;
        }
        elseif($version != null && $version == env("API_VERSION"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function langControl()
    {
        if(request()->hasHeader("lang"))
        {
            $this->lang = request()->header("lang");
        }
        elseif(request()->lang == null)
        {
            $this->lang = "ar";
        }
        else
        {
            $this->lang = request()->lang;
        }
        app()->setLocale($this->lang);
    }



    public function setConfig()
    {
        $this->config = Config::latest()->first();
        if($this->config == null)
        {
            $this->config = new \stdClass();
        }
    }


    public function authUser()
    {
        if(Auth::guard("api")->check())
        {
            $this->auth = true;
            $this->user = Auth::guard("api")->user();
        }
        else
        {
            $this->auth = false;
            $this->user = new User();
            $this->user->id = 0;
        }

    }


    /**
     * @return bool
     */
    public function setApiKey()
    {
        $device_id = request()->header("device");
        $token = request()->header("token");
        if($device_id != null && $token != null) {

            /** @var ApiAccess $apiAccess */
            $apiAccess = ApiAccess::where("device_id", $device_id)->first();

            if (empty($apiAccess)) {
                $input['device_id'] = $device_id;
                $input['api_key'] = $device_id;
                $input['expire_key'] = strtotime(' +1 day');
                $input['token'] = $token;
                ApiAccess::create($input);
            }
            else
            {
                $apiAccess->token = $token;
                $apiAccess->save();
            }
        }

        return true;
    }

    /**
     * @return ApiAccess|null
     */
    public function getApiAccess()
    {
        $device_id = request()->header("device");
        $token = request()->header("token");
        if($device_id != null && $token != null) {

            /** @var ApiAccess $apiAccess */
            $apiAccess = ApiAccess::where("device_id", $device_id)->first();

            if (empty($apiAccess)) {
                return null;
            }
            else
            {
                return $apiAccess;
            }
        }
    }
    public function readNotification()
    {
//        $notification = \request("notification_id");
//        if($notification != null)
//        {
//            $input['is_read'] = 1;
//            Notification::where("id",$notification)->update($input);
//        }
    }


}
