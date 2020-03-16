<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class point extends Model
{
    protected $fillabl = ['number_of_points', 'user_id', 'number_of_students'];
    protected $table = 'points';
    protected $casts = [
        'number_of_points' => 'integer',
        'number_of_students' => 'integer',
        'user_id' => 'integer',
    ];

    public function users()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
