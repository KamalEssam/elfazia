<?php

namespace App\Repositories;

use App\Models\Student;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StudentRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:11 pm EET
 *
 * @method Student findWithoutFail($id, $columns = ['*'])
 * @method Student find($id, $columns = ['*'])
 * @method Student first($columns = ['*'])
*/
class StudentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'mobile',
        'password',
        'email',
        'group_id',
        'center_id',
        'level_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Student::class;
    }
}
