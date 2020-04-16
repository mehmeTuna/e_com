<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayCardRequest;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function creditCard(PayCardRequest $request)
    {
        return response()->json($request);
    }

    public function cart()
    {
        $user = User::find(session('userId'));

        return $user->orders;
        return $this->saveOrders();
    }
}
