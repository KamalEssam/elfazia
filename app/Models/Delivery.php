<?php

namespace App\Models;
use App\Models\Base\BaseModel;
use function Helper\Common\imageUrl;


/**
 * Class User
 * @package App
 *
 * @property string name
 * @property string email
 * @property string image
 * @property string mobile
 * @property string device_token
 * @property integer device_type
 * @property integer active
 * @property integer activation_code
 * @property integer role
 * @property string social_id
 * @property integer delivery_collected
 * @property integer delivery_commission
 * @property string national_id_img
 * @property string driving_license_img
 * @property string bike_license_img
 * @property string check_details_img
 * @property string drugs_img
 * @property integer delivery_salary
 * @property integer id
 * @property string uniqueID
 */
class Delivery extends BaseModel
{

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'image',
        'device_token',
        'device_type',
        'mobile',
        'active',
        'activation_code',
        'role',
        'national_id_img',
        'driving_license_img',
        'bike_license_img',
        'check_details_img',
        'drugs_img',
        'delivery_salary',
        "uniqueID",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** @var array $userPermissions */
    public static $roles = [
        "delivery"=>3,
    ];
    public function transform() {
        $transformer = new Delivery();
        $transformer->username = $this->username;
        $transformer->email = $this->email;
        $transformer->mobile = $this->mobile;
        $transformer->name = $this->name;
        if($this->image == null)
        {
            $transformer->image = url("public/uploads/no_avatar.jpg");
        }
        else
        {
            $transformer->image = $this->image;
        }
        $transformer->active = $this->active;
        $transformer->driving_license_img = imageUrl($this->driving_license_img);
        $transformer->bike_license_img = imageUrl($this->bike_license_img);
        $transformer->national_id_img = imageUrl($this->national_id_img);
        $transformer->drugs_img = imageUrl($this->drugs_img);
        $transformer->check_details_img = imageUrl($this->check_details_img);
        $transformer->delivery_salary = $this->delivery_salary;
        return $transformer;
    }


    /**
     * @return Attendance
     */
    public function checkAttend(){
        $checker = Attendance::where("user_id",$this->id)->where("attend_date",date("Y-m-d"))->first();
        if($checker == null){
            return $checker;
        }else{
            return $checker;
        }
    }


    public function attendances(){
       return $this->hasMany(Attendance::class, "user_id","id");
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function(Delivery $item) {

        });

    }
}
