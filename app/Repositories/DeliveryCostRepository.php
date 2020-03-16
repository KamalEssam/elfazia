<?php

namespace App\Repositories;

use App\Models\DeliveryCost;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeliveryCostRepository
 * @package App\Repositories
 * @version September 16, 2018, 2:30 am EET
 *
 * @method DeliveryCost findWithoutFail($id, $columns = ['*'])
 * @method DeliveryCost find($id, $columns = ['*'])
 * @method DeliveryCost first($columns = ['*'])
*/
class DeliveryCostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number_of_first_kilos',
        'price_for_first_kilos',
        'price_per_kilo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DeliveryCost::class;
    }
}
