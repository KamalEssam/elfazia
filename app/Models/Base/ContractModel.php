<?php
/**
 * Created by PhpStorm.
 * User: ATIAF
 * Date: 13/03/2018
 * Time: 09:47 ص
 */

namespace App\Models\Base;


use Illuminate\Support\Collection;

interface ContractModel
{
    /**
     * @return string
     */
    public static function getLangCode();

    /**
     * @param bool $option
     * @return void
     */
    public static function setAutoTransform($option = true);


    /**
     * @return bool
     */
    public static function getAutoTransform();

    /**
     * @param ContractModel $item
     * @param string $title
     * @return string
     */
    public static function titleSlug($item,$title = "title");


    /**
     * @param ContractModel $item
     * @param bool $is_array
     * @return string
     */
    public static function imageNullable($item , $is_array = false);

    /**
     * @param array $columns
     * @return Collection
     */
    public static function transformAll($columns = ["*"]);


    /**
     * @param Collection $items
     * @return null|string
     */
    public static function returnStaticClass($items);


    /**
     * @param Collection $items
     * @return Collection
     */
    public static function  transformCollection($items = null);


    /**
     * @return ContractModel
     */
    public function  transform();

}