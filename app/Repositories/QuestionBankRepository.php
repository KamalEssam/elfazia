<?php

namespace App\Repositories;

use App\Models\QuestionBank;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionBankRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:06 pm EET
 *
 * @method QuestionBank findWithoutFail($id, $columns = ['*'])
 * @method QuestionBank find($id, $columns = ['*'])
 * @method QuestionBank first($columns = ['*'])
*/
class QuestionBankRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'level_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionBank::class;
    }
}
