<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class StudentExam
 * @package App\Models
 * @version September 17, 2019, 10:36 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer student_id
 * @property integer exam_id
 * @property integer grade
 * @property integer retry_number
 * @property integer start_time
 * @property integer end_time
 */

class StudentExam extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'student_exams';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'student_id',
        'exam_id',
        'grade',
        "retry_number",
        "start_time",
        "end_time",
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'student_id' => 'integer',
        'exam_id' => 'integer',
        'grade' => 'integer',
        "start_time" => "integer",
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

        $transformer = new StudentExam();

        $transformer->id = $this->id;
        $transformer->student_id = $this->student_id;
        $transformer->exam_id = $this->exam_id;
        $transformer->grade = $this->grade;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(StudentExam $item) {

        });
        static::deleted(function(StudentExam $item) {


        });

    }

}
