<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Curriculum
 * @package App\Models
 * @version September 4, 2019, 8:59 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string name
 * @property string description
 * @property string file
 * @property integer level_id
 */

class Curriculum extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'curricula';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'name',
        'description',
        'file',
        'video_url',
        'level_id'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'name' => 'string',
        'description' => 'string',
        'file' => 'string',
        'video_url' => 'string',
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

        $transformer = new Curriculum();

        $transformer->id = $this->id;
        $transformer->name = static::titleSlug($this,"name");
        $transformer->description = static::titleSlug($this,"description");
        $transformer->file = $this->file;
        $transformer->video_url = $this->video_url;
        $transformer->level_id = $this->level_id;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    public function level() {
        return $this->belongsTo(Level::class, "level_id","id");
    }
    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Curriculum $item) {

        });
        static::deleted(function(Curriculum $item) {


        });

    }

}
