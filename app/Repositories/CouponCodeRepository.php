<?php

namespace App\Repositories;

use App\Models\CouponCode;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CouponCodeRepository
 * @package App\Repositories
 * @version October 7, 2018, 12:46 am EET
 *
 * @method CouponCode findWithoutFail($id, $columns = ['*'])
 * @method CouponCode find($id, $columns = ['*'])
 * @method CouponCode first($columns = ['*'])
*/
class CouponCodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'expire_date',
        'discount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CouponCode::class;
    }
}
