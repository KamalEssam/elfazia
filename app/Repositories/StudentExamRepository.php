<?php

namespace App\Repositories;

use App\Models\StudentExam;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StudentExamRepository
 * @package App\Repositories
 * @version September 17, 2019, 10:36 am EET
 *
 * @method StudentExam findWithoutFail($id, $columns = ['*'])
 * @method StudentExam find($id, $columns = ['*'])
 * @method StudentExam first($columns = ['*'])
*/
class StudentExamRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'exam_id',
        'grade'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StudentExam::class;
    }
}
