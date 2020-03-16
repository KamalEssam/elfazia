<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 07/02/2018
 * Time: 10:55 ص
 */

namespace App\Traits\Api;

use App\User;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use App\Http\Controllers\API\ApiController as Api;

/**
 * Trait PassportTrait
 * @package App\Traits\Api
 */
trait PassportTrait
{

    /** @var Client $client */
    private $client = null;

    /**
     * @param int $id
     * @throws Exception
     */
    private function passportClient($id = 1){

        try{
            $this->client = \Laravel\Passport\Client::where('password_client', $id)->first();
            if($this->client == null){
                throw new Exception("please install passport",400);
            }
            $this->client->success = true;
        }catch (ClientException $e){
            throw new Exception("please install passport",400);
        }
    }


    /**
     * @param string $username
     * @param string $password
     * @return string
     * @throws Exception
     */
    public function fireToken( $username = "", $password = "")
    {
        try{
            $this->passportClient();
        }catch (ClientException $e){
            throw new Exception("please install passport",400);
        }


        \request()->request->add([
            'grant_type'    => 'password',
            'client_id'     => $this->client->id,
            'client_secret' => $this->client->secret,
            'username'      => $username,
            'password'      => $password,
            'scope'         => null,
        ]);

        // Fire off the internal request.
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );


        /** @var Request $proxy */
        $proxy = \Route::dispatch($proxy);
        /** @var string $json */
        $json = json_decode($proxy->getContent());


        return $json;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function refreshToken(Request $request)
    {
        $this->passportClient();


        $request->request->add([
            'grant_type'    => 'refresh_token',
            'client_id'     => $this->client->id,
            'client_secret' => $this->client->secret,
            'refresh_token'      => $request->refresh_token,
            'scope'         => null,
        ]);

        // Fire off the internal request.
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );
        return \Route::dispatch($proxy);
    }


    /**
     * @param Api $api
     * @param $user
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondToken(Api $api ,$user , $token)
    {
        $user = User::transform($user);
        $data = $token;
        $data->result = $user;
        $data = (array)$data;
        return $api->respondWithSuccess($data);
    }


    public static function routesPassport()
    {
        // Passport Routes...
        Route::post('refresh/token', 'UserController@refreshToken');
    }


}