<?php

namespace App\Repositories;

use App\Models\Chat;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ChatRepository
 * @package App\Repositories
 * @version September 17, 2018, 6:00 am EET
 *
 * @method Chat findWithoutFail($id, $columns = ['*'])
 * @method Chat find($id, $columns = ['*'])
 * @method Chat first($columns = ['*'])
*/
class ChatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'form',
        'to',
        'message',
        'is_read'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Chat::class;
    }
}
