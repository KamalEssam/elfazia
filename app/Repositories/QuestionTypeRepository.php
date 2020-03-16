<?php

namespace App\Repositories;

use App\Models\QuestionType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionTypeRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:09 pm EET
 *
 * @method QuestionType findWithoutFail($id, $columns = ['*'])
 * @method QuestionType find($id, $columns = ['*'])
 * @method QuestionType first($columns = ['*'])
*/
class QuestionTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'type_custom'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionType::class;
    }
}
