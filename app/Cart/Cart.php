<?php

namespace App\Cart;

use App\Product;

class Cart
{
    public static $idUser = null;
    public static $count = 0 ;

    /**
     * @param string $id
     * @return bool|static
     */
    public static function userId($id = '')
    {
        if($id == '') return false ;
        static::$idUser = $id;
        return new static ;
    }

    /**
     * @param array $cartItem
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public static function add($cartItem = [])
    {
        //product_id, quantity, options
       // if(!is_array($cartItem)) return false ;
       // if(!in_array('productId', $cartItem)) return false ;

        $productId = (int)$cartItem['productId'];
        $options = isset($cartItem['options']) ? $cartItem['options'] : null;
        $quantity = $cartItem['quantity'] ;
        $product = Product::find( $productId);
        if($product == null) return false ;

        $cartItemFind = \App\Cart::where('user_id', self::$idUser)->where('product_id', $productId)->select('quantity')->first();

        if($cartItemFind != null) {
            $quantity += $cartItemFind->quantity ;
        }

        $quantity = (($quantity > $product->minorders) ? $quantity : $product->minorders);
        $totalIsProductPrice = self::priceFormat($product->price * $quantity) ;

        $cartItemFind = \App\Cart::updateOrCreate(['user_id' => self::$idUser, 'product_id' => $productId],[
            'user_id' => self::$idUser,
            'amount' => $totalIsProductPrice,
            'product_id' => $product->id,
            'quantity' => $quantity
        ]);

        return $cartItemFind ;
    }

    /**
     * @param $productId
     * @return bool
     */
    public static function delete($productId)
    {
        return \App\Cart::where('user_id', self::$idUser)->where('product_id', $productId)->delete();
    }

    /**
     * @return int
     */
    public static function getCount()
    {
        return \App\Cart::where('user_id', self::$idUser)->count();
    }

    /**
     * @return \App\Cart[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getItems()
    {
        return \App\Cart::where('user_id', self::$idUser)->with('product')->get();
    }

    /**
     * @param int $price
     * @return string
     */
    public static function priceFormat($price = 0 )
    {
        return number_format((float)$price, 2, '.', '');
    }
}