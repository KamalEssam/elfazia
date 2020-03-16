<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 18/01/2018
 * Time: 04:54 م
 */

namespace App\Models\Base;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class BaseModel extends Model implements ContractModel
{
    /** Trait Model */
    use \App\Models\Base\Model;

    /** @var string $url */
    public static $url = "";

    /** @var bool $autoTransform */
    public static $autoTransform = true;
    /**
     * @return string
     */
    public static function getLangCode() {
        return app()->getLocale();
    }

    /**
     * @param bool $option
     */
    public static function setAutoTransform($option = true) {
        static::$autoTransform = $option;
    }
    /**
     * @return bool
     */
    public static function getAutoTransform(){
        return static::$autoTransform;
    }



    /**
     * @param $item
     */
    public static function setUrl($item){
        
        if(Str::contains($item->image,"storage"))
            static::$url= url("");
        else
            static::$url = url("public/storage") . "/";
    }



    /**
     * @param array $columns
     * @return Collection
     */
    public static function transformAll($columns = ["*"]){
        $items = static::all($columns);
        return static::transformCollection($items);
    }



    /**
     * @param Collection $items
     * @return Collection
     */
    public static function  transformCollection($items = null)
    {
        if($items == null && static::getAutoTransform()){
            $items = self::all();
        }
        $transformers= new Collection();

        /** @var $model */
        /**
        $model = self::returnStaticClass($items);
        if($model != null){
            if($items->count() > 0)
            {
                foreach ($items as $object)
                {
                    $transformers->push($object->transform());
                }
            }
        }*/

        if($items->count() > 0)
        {
            /** @var BaseModel $object */
            foreach ($items as $object)
            {
                $transformers->push($object->transform());
            }
        }

        return $transformers;



    }

    /**
     * @return BaseModel
     */
    public abstract function  transform();

}