<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Group
 * @package App\Models
 * @version September 4, 2019, 8:59 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string name
 * @property integer center_id
 * @property integer level_id
 */

class Group extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'groups';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'name',
        'center_id',
        'level_id'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'name' => 'string',
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

        $transformer = new Group();

        $transformer->id = $this->id;
        $transformer->name = static::titleSlug($this,"name");
        $transformer->center_id = $this->center_id;
        $transformer->level_id = $this->level_id;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Group $item) {

        });
        static::deleted(function(Group $item) {


        });

    }

}
