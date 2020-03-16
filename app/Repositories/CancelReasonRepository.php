<?php

namespace App\Repositories;

use App\Models\CancelReason;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CancelReasonRepository
 * @package App\Repositories
 * @version September 16, 2018, 2:29 am EET
 *
 * @method CancelReason findWithoutFail($id, $columns = ['*'])
 * @method CancelReason find($id, $columns = ['*'])
 * @method CancelReason first($columns = ['*'])
*/
class CancelReasonRepository extends BaseRepository
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
        return CancelReason::class;
    }
}
