<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\User;
use function Helper\Common\upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AppFrontController extends Controller
{

    protected $lang = "ar";
    protected $limit = 10;
    protected $config;
    protected $publicData;
    protected $page_title = "Kanza";
    /** @var User */
    protected $user;
    protected $auth = false;
    public function __construct()
    {
        $this->langControl();
        $this->config = Config::latest("id")->first();
        $this->publicData = $this->config();
        $this->authLogin();
    }

    public function langControl()
    {
        if(Session::has("lang")){
            $this->lang = Session::get("lang");
            Session::put("lang",$this->lang);
            Session::save();
        }else{
            Session::put("lang",$this->lang);
            Session::save();
        }
        app()->setLocale($this->lang);
    }
    public function config(){
        $data['config'] = $this->config->transform();
        return $data;
    }

    public function _404(){
        return view("web.404")
            ->with("page_title",$this->page_title)
            ->with("public_data",$this->publicData);
    }
    public function authLogin(){
        if(Auth::guard("web")->check()){
            $this->auth = true;
            $this->user = Auth::guard("web")->user();
        }else{
            $this->auth = false;
            $this->user = new User();
        }
    }
    public function uploadFile(Request $request,$field , $thum = true)
    {
        if($request->hasFile($field))
        {
            $uploaded = upload($request->file($field),true);
            if(!$thum)
            {
                $file = $uploaded['thum'];
            }else
            {
                $file = $uploaded['img'];
            }
            return $file;
        }
        else
        {
            return "";
        }

    }

}
