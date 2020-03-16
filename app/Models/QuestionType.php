<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class QuestionType
 * @package App\Models
 * @version September 4, 2019, 9:09 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string title
 * @property string type_custom
 */

class QuestionType extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'question_types';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'title',
        'type_custom'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'title' => 'string',
        'type_custom' => 'string'
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

        $transformer = new QuestionType();

        $transformer->id = $this->id;
        $transformer->title = static::titleSlug($this,"title");
        $transformer->type_custom = $this->type_custom;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(QuestionType $item) {

        });
        static::deleted(function(QuestionType $item) {


        });

    }

}
