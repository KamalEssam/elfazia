<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class ReservationRequest
 * @package App\Models
 * @version September 4, 2019, 9:10 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string name
 * @property string email
 * @property string mobile
 * @property integer level_id
 * @property integer group_id
 * @property integer center_id
 */

class ReservationRequest extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'reservation_requests';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'name',
        'email',
        'mobile',
        'level_id',
        'group_id',
        'center_id'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'name' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'level_id' => 'integer',
        'group_id' => 'integer',
        'center_id' => 'integer'
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

        $transformer = new ReservationRequest();

        $transformer->id = $this->id;
        $transformer->name = static::titleSlug($this,"name");
        $transformer->email = $this->email;
        $transformer->mobile = $this->mobile;
        $transformer->level_id = $this->level_id;
        $transformer->group_id = $this->group_id;
        $transformer->center_id = $this->center_id;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }


    public function level() {
        return $this->belongsTo(Level::class, "level_id","id");
    }
    public function center() {
        return $this->belongsTo(Center::class, "center_id","id");
    }
    public function group() {
        return $this->belongsTo(Group::class, "group_id","id");
    }



    protected static function boot()
    {
        parent::boot();

        static::deleting(function(ReservationRequest $item) {

        });
        static::deleted(function(ReservationRequest $item) {


        });

    }

}
