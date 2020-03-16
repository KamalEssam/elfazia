<?php

namespace App\Models;
use App\Models\Base\BaseModel;
use App\User;
use function Helper\Common\__lang;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Order
 * @package App\Models
 * @version September 16, 2018, 2:44 am EET
 *
 * @property integer id
 * @property string uniqueID
 * @property string created_at
 * @property string updated_at
 * @property string from_street
 * @property string from_building
 * @property string from_flat
 * @property string from_floor
 * @property string from_lat
 * @property string from_lng
 * @property integer from_city
 * @property integer from_client_id
 * @property string to_street
 * @property string to_building
 * @property string to_flat
 * @property string to_floor
 * @property string to_lat
 * @property string to_lng
 * @property string to_name
 * @property string to_mobile
 * @property integer to_city
 * @property integer to_client_id
 * @property integer shippment_type
 * @property string shippment_img
 * @property integer status
 * @property integer cash_collected
 * @property double cash_collected_amount
 * @property integer delivery_id
 * @property integer number_of_piece
 * @property integer number_of_kilo
 * @property integer length
 * @property integer width
 * @property integer height
 * @property double price
 * @property integer discount
 * @property integer rate
 * @property string comment
 * @property string delivery_date
 * @property string estimate_delivery_date
 * @property string start_date
 * @property string end_date
 * @property integer cancel_reason_id
 * @property double collected_commission
 * @property bool collected_in_day
 */

class Order extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'orders';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public static $statuses = [
      'waiting'=>0,
      'assign_order_to_delivery' => 1,
        'canceled'=>2,
        'on_way_to_shipper'=>3,
        'item_collected'=>4,
        'on_way_to_customer'=>5,
        'cash_collected'=>6,
        'delivered'=>7,

    ];
    public static $statusesText =[
      0=>"waiting",
      1 => "assign_order_to_delivery",
        2=>"canceled",
        3=>"on_way_to_shipper",
        4=>"item_collected",
        5=>"on_way_to_customer",
        6=>"cash_collected",
        7=>"delivered",

    ];
    public static $shippmentType =[
      'document'=>1,
      'parcel' => 2,
    ];
    public static $shippmentTypeText =[
      1=>"document",
      2 => "parcel",
    ];
    public static $uniqueCode = "FD000";

    public $fillable = [
    'uniqueID',
    'from_street',
        'from_building',
        'from_floor',
        'from_flat',
        'from_lat',
        'from_lng',
        'from_city',
        'from_client_id',
        'to_street',
        'to_building',
        'to_floor',
        'to_flat',
        'to_lat',
        'to_lng',
        'to_name',
        'to_mobile',
        'to_city',
        'to_client_id',
        'shippment_type',
        'shippment_img',
        'status',
        'cash_collected',
        'cash_collected_amount',
        'delivery_id',
        'number_of_piece',
        'number_of_kilo',
        'length',
        'width',
        'height',
        'price',
        'discount',
        'rate',
        'comment',
        'delivery_date',
        'estimate_delivery_date',
        'start_date',
        'end_date',
        'cancel_reason_id',
        'collected_commission',
        "collected_in_day",
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'from_street' => 'string',
        'from_building' => 'string',
        'from_lat' => 'string',
        'from_lng' => 'string',
        'from_city' => 'integer',
        'from_client_id' => 'integer',
        'to_street' => 'string',
        'to_building' => 'string',
        'to_lat' => 'string',
        'to_lng' => 'string',
        'to_city' => 'integer',
        'to_client_id' => 'integer',
        'shippment_type' => 'integer',
        'shippment_img' => 'string',
        'status' => 'integer',
        'cash_collected' => 'integer',
        'cash_collected_amount' => 'double',
        'collected_commission' => 'integer',
        'delivery_id' => 'integer',
        'number_of_piece' => 'integer',
        'number_of_kilo' => 'integer',
        'length' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'price' => 'double',
        'discount' => 'integer',
        'rate' => 'integer',
        'comment' => 'string',
        'delivery_date' => 'string',
        'estimate_delivery_date' => 'string',
        'start_date' => 'string',
        'end_date' => 'string',
        'cancel_reason_id' => 'integer',
        'collected_in_day' => 'bool',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    'from_street' => 'required',
        'from_building' => 'required',
        'from_lat' => 'required',
        'from_lng' => 'required',
        'from_city' => 'required',
        'to_street' => 'required',
        'to_building' => 'required',
        'to_lat' => 'required',
        'to_lng' => 'required',
        'to_city' => 'required',
        'shippment_type' => 'required',
        'cash_collected' => 'required',
        'number_of_piece' => 'required',
        'delivery_date' => 'required'
    ];


    public function  transform()
    {

        $transformer = new Order();

        $transformer->id = $this->id;
        $transformer->uniqueID = $this->uniqueID;
        $transformer->from_street = $this->from_street;
        $transformer->from_building = $this->from_building;
        $transformer->from_flat = $this->from_flat;
        $transformer->from_floor = $this->from_floor;
        $transformer->from_lat = $this->from_lat;
        $transformer->from_lng = $this->from_lng;
        $transformer->from_city = $this->from_city;
        $fromCity = $this->fromCity;
        if($fromCity != null){
            $transformer->from_city_name = self::titleSlug($fromCity , "name");
        }

        $transformer->from_client_id = $this->from_client_id;
        $fromClient = $this->fromClient;
        if($fromClient != null){
            $transformer->from_client = User::transform($fromClient);
        }
        $transformer->to_street = $this->to_street;
        $transformer->to_building = $this->to_building;
        $transformer->to_floor = $this->to_floor;
        $transformer->to_flat = $this->to_flat;
        $transformer->to_lat = $this->to_lat;
        $transformer->to_lng = $this->to_lng;
        $transformer->to_city = $this->to_city;
        $toCity = $this->toCity;
        if($toCity != null){
            $transformer->to_city_name = self::titleSlug($toCity , "name");
        }
        $transformer->to_client_id = $this->to_client_id;
        $toClient = $this->toClient;
        if($toClient != null){
            $transformer->to_client = User::transform($toClient);
        }else{
            $transformer->to_client = new User();
            $transformer->to_client->id = null;
            $transformer->to_client->mobile = $this->to_mobile;
            $transformer->to_client->name = $this->to_name;
            $transformer->to_client->email = null;
            $transformer->to_client->uniqueID = null;
            $transformer->to_client->image = null;
        }
        $transformer->shippment_type = $this->shippment_type;
        $transformer->shippment_img = $this->shippment_img;
        $transformer->status = $this->status;
        $transformer->status_text = __lang(Order::$statusesText[$this->status]);

        $transformer->cash_collected = $this->cash_collected;
        $transformer->collected_in_day = $this->collected_in_day;
        $transformer->cash_collected_amount = $this->cash_collected_amount;
        $transformer->delivery_id = $this->delivery_id;
        $delivery = $this->delivery;
        if($delivery != null){
            $transformer->delivery = User::transform($delivery);
        }
        if($transformer->delivery != null){
            if($transformer->status == 1 || $transformer->status == 3){
                $transformer->to_lat = $transformer->from_lat;
                $transformer->to_lng = $transformer->from_lng;
                $transformer->from_lat = $transformer->delivery->lat;
                $transformer->from_lng = $transformer->delivery->lng;
            }else if($transformer->status > 3){
                $transformer->from_lat = $transformer->delivery->lat;
                $transformer->from_lng = $transformer->delivery->lng;
                $transformer->to_lat = $this->to_lat;
                $transformer->to_lng = $this->to_lng;
            }
        }
        $transformer->number_of_piece = $this->number_of_piece;
        $transformer->number_of_kilo = $this->number_of_kilo;
        $transformer->length = $this->length;
        $transformer->width = $this->width;
        $transformer->height = $this->height;
        $transformer->price = $this->price;
        $transformer->discount = $this->discount;
        $transformer->collected_commission = $this->collected_commission;
        $transformer->rate = $this->rate;
        $transformer->comment = $this->comment;
        $transformer->delivery_date = $this->delivery_date;
        $transformer->estimate_delivery_date = $this->estimate_delivery_date;
        $transformer->start_date = $this->start_date;
        $transformer->end_date = $this->end_date;
        $transformer->cancel_reason_id = $this->cancel_reason_id;

        return $transformer;

    }



    public function fromClient(){
        return $this->belongsTo(User::class,"from_client_id","id");
    }
    public function toClient(){
        return $this->belongsTo(User::class,"to_client_id","id");
    }
    public function delivery(){
        return $this->belongsTo(User::class,"delivery_id","id");
    }
    public function fromCity(){
        return $this->belongsTo(City::class,"from_city","id");
    }
    public function toCity(){
        return $this->belongsTo(City::class,"to_city","id");
    }
    public function cancelReason(){
        return $this->belongsTo(CancelReason::class,"cancel_reason_id","id");
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Order $item) {

        });
        static::deleted(function(Order $item) {


        });

    }

}
