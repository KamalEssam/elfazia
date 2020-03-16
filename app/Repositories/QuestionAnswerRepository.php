<?php

namespace App\Repositories;

use App\Models\QuestionAnswer;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionAnswerRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:02 pm EET
 *
 * @method QuestionAnswer findWithoutFail($id, $columns = ['*'])
 * @method QuestionAnswer find($id, $columns = ['*'])
 * @method QuestionAnswer first($columns = ['*'])
*/
class QuestionAnswerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question_id',
        'student_id',
        'option_id',
        'answer',
        'test_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionAnswer::class;
    }
}
