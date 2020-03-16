<?php

namespace App\Repositories;

use App\Models\QuestionBankGroup;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionBankGroupRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:07 pm EET
 *
 * @method QuestionBankGroup findWithoutFail($id, $columns = ['*'])
 * @method QuestionBankGroup find($id, $columns = ['*'])
 * @method QuestionBankGroup first($columns = ['*'])
*/
class QuestionBankGroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'bank_id',
        'group_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionBankGroup::class;
    }
}
