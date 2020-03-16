<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class DeliveryCost
 * @package App\Models
 * @version September 16, 2018, 2:30 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string from_city_id
 * @property string to_city_id
 * @property integer number_of_first_kilos
 * @property integer price_for_first_kilos
 * @property integer price_per_kilo
 */

class DeliveryCost extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'delivery_costs';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'from_city_id',
    'to_city_id',
    'number_of_first_kilos',
        'price_for_first_kilos',
        'price_per_kilo'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'number_of_first_kilos' => 'integer',
        'price_for_first_kilos' => 'integer',
        'price_per_kilo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    
    ];


    public function  transform()
    {

        $transformer = new DeliveryCost();

        $transformer->id = $this->id;
        $transformer->number_of_first_kilos = $this->number_of_first_kilos;
        $transformer->price_for_first_kilos = $this->price_for_first_kilos;
        $transformer->price_per_kilo = $this->price_per_kilo;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }


    public static function canInsert($city1 , $city2)
    {
        if($city1 == null || $city2 == null){
            return false;
        }
        $checker = DeliveryCost::where(function ($query) use ($city1, $city2) {
            $query->where("from_city_id", $city1)->where("to_city_id", $city2);
        })->orWhere(function ($query) use ($city1, $city2) {
            $query->where("from_city_id", $city2)->where("to_city_id", $city1);
        })->first();

        if($checker == null){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $city1
     * @param $city2
     * @return DeliveryCost|null
     */
    public static function getCost($city1 , $city2)
    {
        if($city1 == null || $city2 == null){
            return null;
        }
        $checker = DeliveryCost::where(function ($query) use ($city1, $city2) {
            $query->where("from_city_id", $city1)->where("to_city_id", $city2);
        })->orWhere(function ($query) use ($city1, $city2) {
            $query->where("from_city_id", $city2)->where("to_city_id", $city1);
        })->first();

        if($checker == null){
            return null;
        }else{
            return $checker;
        }
    }
    public function fromCity(){
        return $this->belongsTo(City::class , "from_city_id","id");
    }
    public function toCity(){
        return $this->belongsTo(City::class , "to_city_id","id");
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(DeliveryCost $item) {

        });
        static::deleted(function(DeliveryCost $item) {


        });

    }

}
