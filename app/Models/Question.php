<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class Question
 * @package App\Models
 * @version September 4, 2019, 9:01 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string title
 * @property string note
 * @property integer question_type_id
 * @property integer question_power_id
 * @property string image
 * @property integer grade
 * @property integer num_of_options
 * @property integer bank_id
 * @property integer is_true
 * @property integer check_answer_by_system
 */

class Question extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'questions';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'title',
        'note',
        'question_type_id',
        'question_power_id',
        'image',
        'grade',
        'num_of_options',
        'bank_id',
        'is_true',
        "check_answer_by_system"
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'title' => 'string',
        'note' => 'string',
        'question_type_id' => 'integer',
        'question_power_id' => 'integer',
        'image' => 'string',
        'grade' => 'integer',
        'num_of_options' => 'integer',
        'bank_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "question_type_id" => "required",
        "question_power_id" => "required",
        "grade" => "required",
    ];


    public function  transform()
    {

        $transformer = new Question();

        $transformer->id = $this->id;
        $transformer->title = static::titleSlug($this,"title");
        $transformer->note = $this->note;
        $transformer->question_type_id = $this->question_type_id;
        $transformer->question_power_id = $this->question_power_id;
        $transformer->image = static::imageNullable($this);
        $transformer->grade = $this->grade;
        $transformer->num_of_options = $this->num_of_options;
        $transformer->bank_id = $this->bank_id;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    public function type() {
        return $this->belongsTo(QuestionType::class, "question_type_id","id");
    }
    public function power() {
        return $this->belongsTo(QuestionPower::class, "question_power_id","id");
    }
    public function options() {
        return $this->hasMany(QuestionOption::class, "question_id","id");
    }
    public function essayAnswers() {
        return $this->hasMany(QuestionEssay::class, "question_id","id");
    }
    public function matches() {
        return $this->hasMany(QuestionDrag::class, "question_id","id");
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Question $item) {

        });
        static::deleted(function(Question $item) {


        });

    }

}
