<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class QuestionEssay
 * @package App\Models
 * @version September 17, 2019, 5:42 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer question_id
 * @property string answer
 */

class QuestionEssay extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'question_essays';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'question_id',
        'answer'
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

        $transformer = new QuestionEssay();

        $transformer->id = $this->id;
        $transformer->question_id = $this->question_id;
        $transformer->answer = $this->answer;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(QuestionEssay $item) {

        });
        static::deleted(function(QuestionEssay $item) {


        });

    }

}
