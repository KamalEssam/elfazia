<?php

namespace App\Repositories;

use App\Models\ReservationRequest;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ReservationRequestRepository
 * @package App\Repositories
 * @version September 4, 2019, 9:10 pm EET
 *
 * @method ReservationRequest findWithoutFail($id, $columns = ['*'])
 * @method ReservationRequest find($id, $columns = ['*'])
 * @method ReservationRequest first($columns = ['*'])
*/
class ReservationRequestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'mobile',
        'level_id',
        'group_id',
        'center_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ReservationRequest::class;
    }
}
