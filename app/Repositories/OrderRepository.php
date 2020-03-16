<?php

namespace App\Repositories;

use App\Models\Order;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version September 16, 2018, 2:44 am EET
 *
 * @method Order findWithoutFail($id, $columns = ['*'])
 * @method Order find($id, $columns = ['*'])
 * @method Order first($columns = ['*'])
*/
class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'from_street',
        'from_building',
        'from_lat',
        'from_lng',
        'from_city',
        'from_client_id',
        'to_street',
        'to_building',
        'to_lat',
        'to_lng',
        'to_city',
        'to_client_id',
        'shippment_type',
        'shippment_img',
        'status',
        'cash_collected',
        'cash_collected_amount',
        'delivery_id',
        'number_of_piece',
        'number_of_kilo',
        'length',
        'width',
        'height',
        'price',
        'discount',
        'rate',
        'comment',
        'delivery_date',
        'estimate_delivery_date',
        'start_date',
        'end_date',
        'cancel_reason_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }
}
