<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 05/02/2018
 * Time: 01:56 م
 */

namespace App\Helpers;


/**
 * Class Pusher
 * @package App\Helpers
 */
class Pusher
{

    /** @var  \Pusher\Pusher */
    private static $pusher;
    /** @var  array|string */
    private static $data;
    /** @var  string $appKey */
    private static $appKey;
    /** @var  string $appSecret */
    private static $appSecret;
    /** @var  string $appId */
    private static $appId;
    /** @var  string $cluster */
    private static $cluster;
    /** @var  string $event */
    private static $event = "new";


    /**
     * @param $data
     * @param string $event
     * @return bool
     */
    public static function fireEvent($data , $event = "new")
    {
        Pusher::initApp($event);
        return Pusher::triggerPusher($data);
    }

    /**
     * @param $event
     */
    private static function initApp($event)
    {
        Pusher::$appId = env("PUSHER_APP_ID");
        Pusher::$appSecret = env("PUSHER_APP_SECRET");
        Pusher::$appKey = env("PUSHER_APP_KEY");
        Pusher::$cluster = env("PUSHER_CLUSTER");
        Pusher::$event = $event;

        Pusher::$pusher = new \Pusher\Pusher( Pusher::$appKey,Pusher::$appSecret, Pusher::$appId
            , array( 'cluster' => Pusher::$cluster, 'encrypted' => true
            , 'curl_options' => array( CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4 ) ) );
    }


    /**
     * @param $data
     * @return bool
     */
    private static function triggerPusher($data)
    {
        if(!is_array($data))
        {
            Pusher::$data['message'] = $data;
        }
        else
        {
            Pusher::$data = $data;
        }
        if(Pusher::$pusher->trigger('my-channel', Pusher::$event, Pusher::$data)){
            return true;
        }
        else
        {
            return false;
        }
    }
}