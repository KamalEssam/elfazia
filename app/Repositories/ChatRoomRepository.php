<?php

namespace App\Repositories;

use App\Models\ChatRoom;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ChatRoomRepository
 * @package App\Repositories
 * @version September 19, 2018, 8:45 am EET
 *
 * @method ChatRoom findWithoutFail($id, $columns = ['*'])
 * @method ChatRoom find($id, $columns = ['*'])
 * @method ChatRoom first($columns = ['*'])
*/
class ChatRoomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'from',
        'to'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ChatRoom::class;
    }
}
