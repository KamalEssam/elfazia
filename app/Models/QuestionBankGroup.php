<?php

namespace App\Models;
use App\Models\Base\BaseModel;

/*
use Illuminate\Database\Eloquent\SoftDeletes;

*/

/**
 * Class QuestionBankGroup
 * @package App\Models
 * @version September 4, 2019, 9:07 pm EET
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property integer bank_id
 * @property integer group_id
 */

class QuestionBankGroup extends BaseModel
{
    /*
        use SoftDeletes;

    */

    public $table = 'question_bank_groups';
    
    /*

    protected $dates = ['deleted_at'];

*/

    public $fillable = [
    'bank_id',
        'group_id'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'bank_id' => 'integer',
        'group_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    
    ];


    public function  transform()
    {

        $transformer = new QuestionBankGroup();

        $transformer->id = $this->id;
        $transformer->bank_id = $this->bank_id;
        $transformer->group_id = $this->group_id;
        $transformer->created_at = $this->created_at;
        $transformer->updated_at = $this->updated_at;

        return $transformer;

    }



    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(QuestionBankGroup $item) {

        });
        static::deleted(function(QuestionBankGroup $item) {


        });

    }

}
