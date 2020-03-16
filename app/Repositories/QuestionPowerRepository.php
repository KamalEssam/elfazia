<?php

namespace App\Repositories;

use App\Models\QuestionPower;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionPowerRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:09 pm EET
 *
 * @method QuestionPower findWithoutFail($id, $columns = ['*'])
 * @method QuestionPower find($id, $columns = ['*'])
 * @method QuestionPower first($columns = ['*'])
*/
class QuestionPowerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionPower::class;
    }
}
