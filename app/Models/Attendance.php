<?php

namespace App\Models;
use App\Models\Base\BaseModel;
use Illuminate\Support\Collection;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Attendance
 * @package App\Models
 * @version September 16, 2018, 2:31 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer user_id
 * @property integer attend
 * @property string attend_date
 * @property string time_attend
 * @property string time_out
 */

class Attendance extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'attendances';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'user_id',
    'attend',
        'attend_date',
        'time_attend',
        'time_out'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'user_id' => 'integer',
    'attend' => 'integer',
        'attend_date' => 'string',
        'time_attend' => 'string',
        'time_out' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    
    ];

    public static function transformCollection($items = null,$date = null)
    {
        $transformers = new Collection();

        if($items->count() > 0)
        {
            /** @var Attendance $object */
            foreach ($items as $object)
            {
                $transformers->push($object->transform($date));
            }
        }

        return $transformers;
    }

    public function  transform($date = null)
    {

        $transformer = new Attendance();

        $transformer->id = $this->id;
        $transformer->delivery = $this->delivery;
        if($date == $this->attend_date){
            $transformer->attend = true;
            $transformer->attend_date = $date;
            $transformer->time_attend = $this->time_attend;
            $transformer->time_out = $this->time_out;
        }else{
            $transformer->attend = null;
            $transformer->attend_date = $date;
            $transformer->time_attend = null;
            $transformer->time_out = null;
        }


        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }





    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Attendance $item) {

        });
        static::deleted(function(Attendance $item) {


        });

    }

}
