<?php

namespace App\Repositories;

use App\Models\UserWallet;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserWalletRepository
 * @package App\Repositories
 * @version October 5, 2018, 3:54 am EET
 *
 * @method UserWallet findWithoutFail($id, $columns = ['*'])
 * @method UserWallet find($id, $columns = ['*'])
 * @method UserWallet first($columns = ['*'])
*/
class UserWalletRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'message',
        'cost',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserWallet::class;
    }
}
