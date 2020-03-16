<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class QuestionOption
 * @package App\Models
 * @version September 4, 2019, 9:08 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string title
 * @property integer question_id
 * @property integer is_true
 * @property integer ordered
 */

class QuestionOption extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'question_options';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'title',
        'question_id',
        'is_true',
        'ordered'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'title' => 'string',
        'question_id' => 'integer',
        'is_true' => 'integer',
        'ordered' => 'integer'
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

        $transformer = new QuestionOption();

        $transformer->id = $this->id;
        $transformer->title = static::titleSlug($this,"title");
        $transformer->question_id = $this->question_id;
        $transformer->is_true = $this->is_true;
        $transformer->ordered = $this->ordered;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(QuestionOption $item) {

        });
        static::deleted(function(QuestionOption $item) {


        });

    }

}
