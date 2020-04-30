<?php

namespace App\Observers;

use App\Cart;
use Webpatser\Uuid\Uuid;

class CartObserver
{
    public function creating(Cart $cart)
    {
        $cart->uuid = Uuid::generate();
    }
}