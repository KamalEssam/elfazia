<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class CouponCode
 * @package App\Models
 * @version October 7, 2018, 12:46 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string code
 * @property string expire_date
 * @property integer discount
 */

class CouponCode extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'coupon_codes';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'code',
        'expire_date',
        'discount'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'code' => 'string',
        'expire_date' => 'string',
        'discount' => 'integer'
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

        $transformer = new CouponCode();

        $transformer->id = $this->id;
        $transformer->code = $this->code;
        $transformer->expire_date = $this->expire_date;
        $transformer->discount = $this->discount;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(CouponCode $item) {

        });
        static::deleted(function(CouponCode $item) {


        });

    }

}
