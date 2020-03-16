<?php

namespace App\Repositories;

use App\Models\apiAccess;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class apiAccessRepository
 * @package App\Repositories
 * @version September 28, 2017, 1:22 pm UTC
 *
 * @method apiAccess findWithoutFail($id, $columns = ['*'])
 * @method apiAccess find($id, $columns = ['*'])
 * @method apiAccess first($columns = ['*'])
*/
class apiAccessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'api_key',
        'device_id',
        'expire_key'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return apiAccess::class;
    }
}
