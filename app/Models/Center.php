<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Center
 * @package App\Models
 * @version September 4, 2019, 8:58 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string name
 * @property string address
 * @property string mobile
 */

class Center extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'centers';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'name',
        'address',
        'mobile'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'name' => 'string',
        'address' => 'string',
        'mobile' => 'string'
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

        $transformer = new Center();

        $transformer->id = $this->id;
        $transformer->name = static::titleSlug($this,"name");
        $transformer->address = $this->address;
        $transformer->mobile = $this->mobile;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Center $item) {

        });
        static::deleted(function(Center $item) {


        });

    }

}
