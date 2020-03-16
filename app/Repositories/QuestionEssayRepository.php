<?php

namespace App\Repositories;

use App\Models\QuestionEssay;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionEssayRepository
 * @package App\Repositories
 * @version September 17, 2019, 5:42 pm EET
 *
 * @method QuestionEssay findWithoutFail($id, $columns = ['*'])
 * @method QuestionEssay find($id, $columns = ['*'])
 * @method QuestionEssay first($columns = ['*'])
*/
class QuestionEssayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question_id',
        'answer'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionEssay::class;
    }
}
