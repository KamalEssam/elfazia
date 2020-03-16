<?php

namespace App\Repositories;

use App\Models\QuestionDrag;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionDragRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:07 pm EET
 *
 * @method QuestionDrag findWithoutFail($id, $columns = ['*'])
 * @method QuestionDrag find($id, $columns = ['*'])
 * @method QuestionDrag first($columns = ['*'])
*/
class QuestionDragRepository extends BaseRepository
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
        return QuestionDrag::class;
    }
}
