<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class QuestionDrag
 * @package App\Models
 * @version September 4, 2019, 9:07 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer question_id
 * @property string title
 * @property string answer
 */

class QuestionDrag extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'question_drags';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'question_id',
        'answer',
        "title",
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'question_id' => 'integer',
        'answer' => 'string'
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

        $transformer = new QuestionDrag();

        $transformer->id = $this->id;
        $transformer->question_id = $this->question_id;
        $transformer->answer = $this->answer;
        $transformer->title = $this->title;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(QuestionDrag $item) {

        });
        static::deleted(function(QuestionDrag $item) {


        });

    }

}
