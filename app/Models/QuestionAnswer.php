<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class QuestionAnswer
 * @package App\Models
 * @version September 4, 2019, 9:02 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer question_id
 * @property integer student_id
 * @property integer option_id
 * @property string answer
 * @property integer test_id
 * @property integer is_true
 * @property integer grade
 * @property integer is_true_answer
 */

class QuestionAnswer extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'question_answers';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'question_id',
        'student_id',
        'option_id',
        'answer',
        'test_id'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'question_id' => 'integer',
        'student_id' => 'integer',
        'option_id' => 'integer',
        'answer' => 'string',
        'test_id' => 'integer'
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

        $transformer = new QuestionAnswer();

        $transformer->id = $this->id;
        $transformer->question_id = $this->question_id;
        $transformer->student_id = $this->student_id;
        $transformer->option_id = $this->option_id;
        $transformer->answer = $this->answer;
        $transformer->test_id = $this->test_id;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(QuestionAnswer $item) {

        });
        static::deleted(function(QuestionAnswer $item) {


        });

    }

}
