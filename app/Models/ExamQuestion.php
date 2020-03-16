<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class ExamQuestion
 * @package App\Models
 * @version September 12, 2019, 3:03 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer exam_id
 * @property integer question_id
 */

class ExamQuestion extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'exam_questions';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'exam_id',
        'question_id'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'exam_id' => 'integer',
        'question_id' => 'integer'
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

        $transformer = new ExamQuestion();

        $transformer->id = $this->id;
        $transformer->exam_id = $this->exam_id;
        $transformer->question_id = $this->question_id;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(ExamQuestion $item) {

        });
        static::deleted(function(ExamQuestion $item) {


        });

    }

}
