<?php

namespace App\Repositories;

use App\Models\ExamQuestion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ExamQuestionRepository
 * @package App\Repositories
 * @version September 12, 2019, 3:03 am EET
 *
 * @method ExamQuestion findWithoutFail($id, $columns = ['*'])
 * @method ExamQuestion find($id, $columns = ['*'])
 * @method ExamQuestion first($columns = ['*'])
*/
class ExamQuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'exam_id',
        'question_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ExamQuestion::class;
    }
}
