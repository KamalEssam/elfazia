<?php

namespace App\Models;
use App\Models\Base\BaseModel;
use App\User;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Student
 * @package App\Models
 * @version September 4, 2019, 9:11 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer user_id
 * @property integer group_id
 * @property integer center_id
 * @property integer level_id
 */

class Student extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'students';
    
    /*


    protected $dates = ['deleted_at'];

*/

    protected $hidden = [
      "password"
    ];
    public $fillable = [
        'group_id',
        'center_id',
        'level_id',
        'user_id',
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

        'group_id' => 'integer',
        'center_id' => 'integer',
        'level_id' => 'integer'
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

        $transformer = new Student();

        $transformer->id = $this->id;
//        $transformer->name = static::titleSlug($this,"name");
//        $transformer->mobile = $this->mobile;
//        $transformer->password = $this->password;
//        $transformer->email = $this->email;
        $transformer->group_id = $this->group_id;
        $transformer->center_id = $this->center_id;
        $transformer->level_id = $this->level_id;
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
    public function user() {
        return $this->belongsTo(User::class, "user_id","id");
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Student $item) {

        });
        static::deleted(function(Student $item) {


        });

    }

}
