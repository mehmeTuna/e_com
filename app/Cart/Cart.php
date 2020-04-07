<?php

namespace App\Cart;

class Cart
{
    public static $userId = null;
    public static $count = 0 ;


    /**
     * @param $id
     * @return static
     */
    public static function id($id)
    {
        static::$userId = $id;
        return new static;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return self::$count ;
    }
}