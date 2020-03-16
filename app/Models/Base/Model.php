<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 13/03/2018
 * Time: 10:00 ص
 */

namespace App\Models\Base;


use Illuminate\Support\Collection;

trait Model
{
    /**
     * @param BaseModel|Collection $item
     * @param bool $is_array
     * @return string
     */
    public static function imageNullable($item , $is_array = false)
    {


        static::$url = url("");

        if($is_array) {
            if (count($item) > 0){
                self::setUrl($item[0]);
                return static::$url . $item[0]->image;
            }
            else
                return null;
        }
        else
        {
            self::setUrl($item);

            if(isset($item->image) && $item->image != null)
                return static::$url . $item->image;
            elseif(isset($item->img) && $item->img != null)
                return static::$url . $item->img;
            else
                return null;
        }

    }
    /**
     * @param BaseModel $item
     * @param string $title
     * @return string
     */
    public static function titleSlug($item,$title = "title")
    {
        $slug = $title."_".self::getLangCode();
        return  $item->$slug;
    }


    /**
     * @param Collection $items
     * @return null|string
     */
    public static function returnStaticClass($items){
        if($items instanceof Collection && isset($items[0])){
            return get_class($items[0]);
        }elseif($items instanceof Model){
            return get_class($items);
        }else{
            return null;
        }
    }

}