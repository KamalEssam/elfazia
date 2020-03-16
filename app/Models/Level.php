<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Level
 * @package App\Models
 * @version September 4, 2019, 9:00 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string name
 */

class Level extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'levels';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'name'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'name' => 'string'
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

        $transformer = new Level();

        $transformer->id = $this->id;
        $transformer->name = static::titleSlug($this,"name");
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Level $item) {

        });
        static::deleted(function(Level $item) {


        });

    }

}
