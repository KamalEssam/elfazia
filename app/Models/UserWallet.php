<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class UserWallet
 * @package App\Models
 * @version October 5, 2018, 3:54 am EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string message
 * @property integer cost
 * @property integer user_id
 * @property integer type_of_cost
 */
class UserWallet extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'user_wallets';

    /*

    protected $dates = ['deleted_at'];

*/

    public static $costs = [
        "to_admin" => 1,
        "to_client" => 2,
        "to_teacher" => 3,
        "to_manager" => 4,
    ];

    public $fillable = [
        'message',
        'cost',
        'user_id',
        'type_of_cost',
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'message' => 'string',
        'cost' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function transform()
    {

        $transformer = new UserWallet();

        $transformer->id = $this->id;
        $transformer->message = $this->message;
        $transformer->cost = $this->cost;

        return $transformer;

    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function (UserWallet $item) {

        });
        static::deleted(function (UserWallet $item) {


        });

    }

}
