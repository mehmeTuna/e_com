<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $userId = 101;

    public function __construct()
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $cart = Cart::userId($this->userId)->add([
            'productId' => $request->productId,
            'quantity' => $request->quantity
        ]);

        return response()
        ->json($cart);
    }

    public function delete(Request $request)
    {
        return Cart::userId($this->userId)->delete($request->productId);
    }

    public function getCartCount()
    {
        return Cart::userId($this->userId)->getCount();
    }

    public function getCartItems()
    {
        return Cart::userId($this->userId)->getItems();
    }
}
