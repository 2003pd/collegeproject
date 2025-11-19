<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function pay(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'order_rcptid_'.rand(1000,9999),
            'amount' => $request->amount * 100, // in paise
            'currency' => 'INR'
        ]);

        return view('payment', ['order' => $order]);
    }
}
