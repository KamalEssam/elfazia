<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class apiAccess
 * @package App\Models
 * @version September 28, 2017, 1:22 pm UTC
 *
 * @property string api_key
 * @property string device_id
 * @property string expire_key
 * @property string token
 * @property integer device_type
 */
class ApiAccess extends BaseModel
{
    use SoftDeletes;

    public $table = 'api_accesses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'api_key',
        'device_id',
        'expire_key',
        'token',
        'device_type',
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'api_key' => 'string',
        'device_id' => 'string',
        'expire_key' => 'string',
        'token' =>"string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    /**
     * @return BaseModel
     */
    public function transform()
    {
        // TODO: Implement transform() method.
    }
}
