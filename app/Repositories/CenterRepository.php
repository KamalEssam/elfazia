<?php

namespace App\Repositories;

use App\Models\Center;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CenterRepository
 * @package App\Repositories
 * @version September 4, 2019, 8:58 pm EET
 *
 * @method Center findWithoutFail($id, $columns = ['*'])
 * @method Center find($id, $columns = ['*'])
 * @method Center first($columns = ['*'])
*/
class CenterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'mobile'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Center::class;
    }
}
