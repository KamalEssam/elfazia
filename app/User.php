<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App
 *
 * @property string name
 * @property string username
 * @property string email
 * @property string image
 * @property string device_token
 * @property integer device_type
 * @property integer active
 * @property integer points
 * @property integer activation_code
 * @property integer role  '1-> admin 2-> student 3-> teacher 4->manager
 * @property integer id
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /** @var array $userPermissions */
    public static $userPermissions = [
        "home",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'image', 'device_token', 'device_type', 'mobile', 'active', 'activation_code', 'points', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $roles = [
        "admin" => 1,
        "student" => 2,
        "teacher" => 3,
        "manager" => 4,
    ];

    public static function transform(User $item)
    {
        $transformer = new User();
        $transformer->username = $item->username;
        $transformer->email = $item->email;
        $transformer->mobile = $item->mobile;
        $transformer->name = $item->name;
        if ($item->image == null) {
            $transformer->image = url("public/uploads/no_avatar.jpg");
        } else {
            $transformer->image = $item->image;
        }
        $transformer->activation_code = $item->activation_code;
        $transformer->active = $item->active;
        return $transformer;
    }


    public static function deleteRelations(User $item)
    {

    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (User $item) {
            self::deleteRelations($item);
        });

    }

    /*
     * @user relation with point one to one
     * */
    public function points(){
        return $this->belongsTo(point::class,'user_id');
    }
}
