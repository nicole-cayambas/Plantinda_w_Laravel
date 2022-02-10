<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Address;

class CheckoutController extends Controller
{
    public function index () {
        $address = Address::find(auth()->user()->address_id);
        return view('checkout.index')->with('address', $address);
    }

    public function sendAddress(Request $request){
    }

    public function store(Request $request){
        dd('checkout');
        $order = new Order;
        $order->product_id = $request->input('product_id');
        $order->user_id = auth()->user()->id;
        $order->store_id = 1;
        $order->quantity = (int)$request->input('quantity');
        $order->unit_price = (double)$request->input('price');
        $order->shipping_price = (double)50;
        $order->total_price = (double)$request->input('price') * (int)$request->input('quantity') + 50;
        $order->save();
        if(auth()->user()->address_id != null){
                $payment = new Payment;
                $payment->user_id = auth()->user()->id;
                $payment->order_id = $order->id;
                $payment->payment_type = 'cash';
                $payment->status = 'pending';
                $payment->save();
                return view('checkout.orderConfirmation')->with('success', 'Order placed successfully')->with('error', 'Order failed');
        } else {
            return redirect()->route('editAddress');
        }
    }
}
