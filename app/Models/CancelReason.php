<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class CancelReason
 * @package App\Models
 * @version September 16, 2018, 2:29 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string name_ar
 * @property string name_en
 */

class CancelReason extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'cancel_reasons';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'name_ar',
        'name_en'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'name_ar' => 'string',
        'name_en' => 'string'
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

        $transformer = new CancelReason();

        $transformer->id = $this->id;
        $transformer->name = static::titleSlug($this,"name");

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(CancelReason $item) {

        });
        static::deleted(function(CancelReason $item) {


        });

    }

}
