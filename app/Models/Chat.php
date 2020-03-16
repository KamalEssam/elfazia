<?php

namespace App\Models;
use App\Http\Controllers\API\ApiController;
use App\Models\Base\BaseModel;
use App\Models\Base\Model;
use App\User;
use Illuminate\Support\Collection;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Chat
 * @package App\Models
 * @version September 17, 2018, 6:00 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer room_id
 * @property integer from
 * @property integer to
 * @property string message
 * @property integer is_read
 * @property ChatRoom room
 */

class Chat extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'chats';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'from',
        'to',
        'room_id',
        'message',
        'is_read'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'room_id'=>"integer",
    'from' => 'integer',
        'to' => 'integer',
        'message' => 'string',
        'is_read' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    
    ];

    /** @var $apiController ApiController */
    public static  $apiController;


    public function  transform()
    {

        if(static::$apiController == null){
            static::$apiController = new ApiController();
        }

        $transformer = new Chat();

        $transformer->id = $this->id;
        $transformer->room_id = $this->room_id;
        $transformer->from = $this->from;
        $transformer->to = $this->to;
        $transformer->message = $this->message;
        $transformer->is_read = $this->is_read;
        if($this->from == static::$apiController->user->id){
            $transformer->from_you = true;
        }else{
            $transformer->from_you = false;
        }
        if(static::$apiController->auth){
            if(static::$apiController->user->id == $this->from){
                $to = $this->toUser;
                if($to != null){
                    $transformer->user = User::transform($to);
                }else{
                    $transformer->user = new \stdClass();
                }
            }
            else if(static::$apiController->user->id == $this->to){
                $to = $this->fromUser;
                if($to != null){
                    $transformer->user = User::transform($to);
                }else{
                    $transformer->user = new \stdClass();
                }
            }
        }
        //** set order data */
        $room = $this->room;
        if($room != null){
            $order = $room->order;
            if($order != null){
                $transformer->order_uniqueID = $order->uniqueID;
            }else{
                $transformer->order_uniqueID = "";
            }
        }else{
            $transformer->order_uniqueID = "";
        }

        return $transformer;

    }

    public function  transformAdmin()
    {



        $transformer = new Chat();

        $transformer->id = $this->id;
        $transformer->room_id = $this->room_id;
        $transformer->from = $this->from;
        $transformer->to = $this->to;
        $transformer->message = $this->message;
        $transformer->is_read = $this->is_read;
        $transformer->created_at = $this->created_at;


        $to = $this->toUser;
        if($to != null){
            $transformer->to_user = User::transform($to);
        }
        $from = $this->fromUser;
        if($from != null){
            $transformer->from_user = User::transform($from);
        }

        return $transformer;

    }

    public function room(){
        return $this->belongsTo(ChatRoom::class , "room_id","id");
    }

    public function fromUser(){
        return $this->belongsTo(User::class , "from","id");
    }

    public function toUser(){
        return $this->belongsTo(User::class , "to","id");
    }

    public static function messageCount($user_id){
        $count = static::where("is_read",0)->where("to",$user_id)->groupBy("room_id")->get()->count();
        return $count;
    }



    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Chat $item) {

        });
        static::deleted(function(Chat $item) {


        });

    }

}
