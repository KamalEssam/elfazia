<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Config
 * @package App\Models
 * @version September 16, 2018, 2:28 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string max_height
 * @property string max_width
 * @property string max_length
 * @property string max_weight
 * @property string dvided_ratio
 * @property string max_hour_ship
 * @property integer delivery_commission
 * @property string rules_ar
 * @property string rules_en
 * @property string about_us_ar
 * @property string about_us_en
 * @property integer cancelation_cost
 * @property integer collected_commission
 */

class Config extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'configs';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'max_height',
        'max_width',
        'max_length',
        'max_weight',
        'dvided_ratio',
        'max_hour_ship',
        'delivery_commission',
        'rules_ar',
        'rules_en',
        'about_us_ar',
        'about_us_en',
        'cancelation_cost',
        'collected_commission',
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'max_height' => 'string',
        'max_width' => 'string',
        'max_length' => 'string',
        'dvided_ratio' => 'string',
        'max_hour_ship' => 'string',
        'delivery_commission' => 'integer',
        'collected_commission' => 'integer',
        'rules_ar' => 'string',
        'rules_en' => 'string',
        'about_us_ar' => 'string',
        'about_us_en' => 'string'
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

        $transformer = new Config();

        $transformer->id = $this->id;
        $transformer->max_height = $this->max_height;
        $transformer->max_width = $this->max_width;
        $transformer->max_length = $this->max_length;
        $transformer->dvided_ratio = $this->dvided_ratio;
        $transformer->max_hour_ship = $this->max_hour_ship;
        $transformer->delivery_commission = $this->delivery_commission;
        $transformer->rules = static::titleSlug($this,"rules");
        $transformer->about_us = static::titleSlug($this,"about_us");

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Config $item) {

        });
        static::deleted(function(Config $item) {


        });

    }

}
