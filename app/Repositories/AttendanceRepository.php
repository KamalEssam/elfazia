<?php

namespace App\Repositories;

use App\Models\Attendance;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AttendanceRepository
 * @package App\Repositories
 * @version September 16, 2018, 2:31 am EET
 *
 * @method Attendance findWithoutFail($id, $columns = ['*'])
 * @method Attendance find($id, $columns = ['*'])
 * @method Attendance first($columns = ['*'])
*/
class AttendanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'attend',
        'attend_date',
        'time_attend',
        'time_out'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Attendance::class;
    }
}
