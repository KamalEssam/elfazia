<?php

namespace App\Repositories;

use App\Models\City;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CityRepository
 * @package App\Repositories
 * @version September 16, 2018, 2:28 am EET
 *
 * @method City findWithoutFail($id, $columns = ['*'])
 * @method City find($id, $columns = ['*'])
 * @method City first($columns = ['*'])
*/
class CityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_ar',
        'name_en'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return City::class;
    }
}
