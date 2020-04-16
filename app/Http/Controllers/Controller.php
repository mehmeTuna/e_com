<?php

namespace App\Http\Controllers;

use App\OrderItems;
use App\User;
use App\Orders;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function cartItems()
    {
        return session('cart', []);
    }

    protected function cartTotal()
    {
        return session('cartTotal', 0);
    }

    protected function saveOrders()
    {
        $id = session('userId');
        $items = $this->cartItems();
        $cartTotal = $this->cartTotal();

        $user = User::find($id);
        $orders = Orders::create([
            'user_id' => $id,
            'adress' => $user->adress,
            'order_amount' => $cartTotal,
            'm_status' => 0,
        ]);

        foreach ($items as $value)
        {
            if($value['quantity'] > 0)
            {
                $items = OrderItems::create([
                    'order_id' => $orders['id'],
                    'productId' => $value['id'],
                    'price' => number_format(round($value['price'], 2), 2, '.', '')
                ]);
            }

            foreach ($value['options']['checkBox'] as $option)
            {
                foreach ($option as $item)
                {
                    $items = OrderItems::create([
                        'order_id' => $orders['id'],
                        'productId' => $value['id'],
                        'price' => isset($item['price']) ? number_format(round($item['price'], 2), 2, '.', '') : 0,
                        'checkbox' => $item['id']
                    ]);
                }
            }

            foreach ($value['options']['selectBox'] as $option)
            {
                foreach ($option as $item)
                {
                    $items = OrderItems::create([
                        'order_id' => $orders['id'],
                        'productId' => $value['id'],
                        'price' => isset($item['price']) ? number_format(round($item['price'], 2), 2, '.', '') : 0,
                        'selectbox' => $item['id']
                    ]);
                }
            }

        }
    }
}
