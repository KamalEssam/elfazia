<?php

namespace App\Repositories;

use App\Models\Config;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ConfigRepository
 * @package App\Repositories
 * @version September 16, 2018, 2:28 am EET
 *
 * @method Config findWithoutFail($id, $columns = ['*'])
 * @method Config find($id, $columns = ['*'])
 * @method Config first($columns = ['*'])
*/
class ConfigRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'max_height',
        'max_width',
        'max_length',
        'max_weight',
        'dvided_ratio',
        'max_hour_ship',
        'rules_ar',
        'rules_en',
        'about_us_ar',
        'about_us_en'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Config::class;
    }
}
