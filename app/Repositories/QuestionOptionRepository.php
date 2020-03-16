<?php

namespace App\Repositories;

use App\Models\QuestionOption;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionOptionRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:08 pm EET
 *
 * @method QuestionOption findWithoutFail($id, $columns = ['*'])
 * @method QuestionOption find($id, $columns = ['*'])
 * @method QuestionOption first($columns = ['*'])
*/
class QuestionOptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'question_id',
        'is_true',
        'ordered'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionOption::class;
    }
}
