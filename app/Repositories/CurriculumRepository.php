<?php

namespace App\Repositories;

use App\Models\Curriculum;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CurriculumRepository
 * @package App\Repositories
 * @version September 4, 2019, 8:59 pm EET
 *
 * @method Curriculum findWithoutFail($id, $columns = ['*'])
 * @method Curriculum find($id, $columns = ['*'])
 * @method Curriculum first($columns = ['*'])
*/
class CurriculumRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file',
        'level_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Curriculum::class;
    }
}
