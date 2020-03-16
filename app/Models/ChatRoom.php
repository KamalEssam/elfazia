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
 * Class ChatRoom
 * @package App\Models
 * @version September 19, 2018, 8:45 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer from
 * @property integer to
 * @property integer order_id
 * @property Order order
 */

class ChatRoom extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'chat_rooms';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'from',
        'to',
        "order_id",
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'from' => 'integer',
        'to' => 'integer'
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


        $transformer = new ChatRoom();

        $transformer->id = $this->id;
        $transformer->from = $this->from;
        $transformer->to = $this->to;


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
        /** @var Chat $lastMessage */
        $lastMessage = $this->messages()->latest("id")->first();
        if($lastMessage != null){
            $transformer->message = $lastMessage->transform();
        }
        $transformer->created_at = (string) $this->created_at;

        return $transformer;

    }


    public function order(){
        return $this->belongsTo(Order::class , "order_id","id");
    }

    public function fromUser(){
        return $this->belongsTo(User::class , "from","id");
    }

    public function toUser(){
        return $this->belongsTo(User::class , "to","id");
    }
    public function messages(){
        return $this->hasMany(Chat::class , "room_id","id");
    }


    /**
     * @param $userFrom
     * @param $userTo
     * @param $order_id
     * @return null|ChatRoom
     */
    public static function canInsert($userFrom,$userTo,$order_id)
    {
        if($userFrom == null || $userTo == null){
            return null;
        }
        $checker = ChatRoom::where(function ($query) use ($userFrom, $userTo,$order_id) {
            $query->where("from", $userFrom)->where("to", $userTo)->where("order_id",$order_id);
        })->orWhere(function ($query) use ($userFrom, $userTo,$order_id) {
            $query->where("to", $userFrom)->where("from", $userTo)->where("order_id",$order_id);
        })->first();
        if($checker == null){
            return null;
        }else{
            return $checker;
        }
    }

    /**
     * @param $userFrom
     * @return Model|null
     */
    public static function getRooms($userFrom)
    {
        if($userFrom == null){
            return new Collection();
        }
        $checker = ChatRoom::where(function ($query) use ($userFrom) {
            $query->where("from", $userFrom);
        })->orWhere(function ($query) use ($userFrom) {
            $query->where("to", $userFrom);
        });

        return $checker;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(ChatRoom $item) {

        });
        static::deleted(function(ChatRoom $item) {


        });

    }

}
