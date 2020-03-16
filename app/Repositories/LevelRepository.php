<?php

namespace App\Repositories;

use App\Models\Level;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LevelRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:00 pm EET
 *
 * @method Level findWithoutFail($id, $columns = ['*'])
 * @method Level find($id, $columns = ['*'])
 * @method Level first($columns = ['*'])
*/
class LevelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Level::class;
    }
}
