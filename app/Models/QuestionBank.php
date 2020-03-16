<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class QuestionBank
 * @package App\Models
 * @version September 4, 2019, 9:06 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string title
 * @property string description
 * @property integer description_hide
 * @property integer retry_hide
 * @property integer shuffle
 * @property integer shuffle_answers
 * @property integer has_end_time
 * @property integer time_of_bank
 * @property integer full_display
 * @property integer guest_hide
 * @property string link_temp
 * @property integer must_answer_all_bank
 * @property integer power_question_hide
 * @property integer level_id
 * @property string code
 * @property integer is_exam
 */

class QuestionBank extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'question_banks';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'title',
        'description',
        'description_hide',
        'retry_hide',
        'shuffle',
        'shuffle_answers',
        'has_end_time',
        'time_of_bank',
        'full_display',
        'guest_hide',
        'link_temp',
        'must_answer_all_bank',
        'power_question_hide',
        'level_id',
        'code',
        'is_exam',
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'title' => 'string',
        'description' => 'string',
        'description_hide' => 'integer',
        'retry_hide' => 'integer',
        'shuffle' => 'integer',
        'shuffle_answers' => 'integer',
        'has_end_time' => 'integer',
        'time_of_bank' => 'integer',
        'full_display' => 'integer',
        'guest_hide' => 'integer',
        'link_temp' => 'string',
        'must_answer_all_bank' => 'integer',
        'power_question_hide' => 'integer',
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

        $transformer = new QuestionBank();

        $transformer->id = $this->id;
        $transformer->title = static::titleSlug($this,"title");
        $transformer->description = static::titleSlug($this,"description");
        $transformer->description_hide = $this->description_hide;
        $transformer->retry_hide = $this->retry_hide;
        $transformer->shuffle = $this->shuffle;
        $transformer->shuffle_answers = $this->shuffle_answers;
        $transformer->has_end_time = $this->has_end_time;
        $transformer->time_of_bank = $this->time_of_bank;
        $transformer->full_display = $this->full_display;
        $transformer->guest_hide = $this->guest_hide;
        $transformer->link_temp = $this->link_temp;
        $transformer->must_answer_all_bank = $this->must_answer_all_bank;
        $transformer->power_question_hide = $this->power_question_hide;
        $transformer->level_id = $this->level_id;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }




    public function level() {
        return $this->belongsTo(Level::class, "level_id","id");
    }

    public function groups() {
        return $this->hasMany(QuestionBankGroup::class, "bank_id","id");
    }
    public function questions() {
        return $this->hasMany(Question::class, "bank_id","id");
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(QuestionBank $item) {

        });
        static::deleted(function(QuestionBank $item) {


        });

    }

}
