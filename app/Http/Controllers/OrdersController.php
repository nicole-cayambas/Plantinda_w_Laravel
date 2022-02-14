<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Address;

class OrdersController extends Controller
{

    public function finalizeAddress(Request $request){
        $user = auth()->user();
        if(auth()->user()->address_id != null){
            $address = Address::find($user->address_id);
            $address->first_name = $request->input('first-name');
            $address->last_name = $request->input('last-name');
            $address->phone_number = $request->input('phone-number');
            $address->address = $request->input('street-address');
            $address->barangay = $request->input('barangay');
            $address->city = $request->input('city');
            $address->zip = $request->input('zip-code');
            $address->province = $request->input('province');
            $address->save();
            $user->address_id = $address->id;
            $user->save();
        } else {
            $address = new Address;
            $address->user_id = $user->id;
            $address->first_name = $request->input('first-name');
            $address->last_name = $request->input('last-name');
            $address->phone_number = $request->input('phone-number');
            $address->address = $request->input('street-address');
            $address->barangay = $request->input('barangay');
            $address->city = $request->input('city');
            $address->zip = $request->input('zip-code');
            $address->province = $request->input('province');
            $address->save();
            $user->address_id = $address->id;
            $user->save();
        }
        return view('checkout.index')->with('address', $address)->with('request', $request);
    }

    public function sendPayment(Request $request){
    }

    public function store(Request $request) {

        $order = new Order;

        $order->product_id = $request->input('product_id');
        $order->product_name = $request->input('product_name');
        $order->user_id = auth()->user()->id;
        $order->store_id = 1;
        $order->quantity = $request->input('quantity');
        $order->unit_price = $request->input('price');
        $order->shipping_price = $request->input('shipping_price');
        $order->total_price = $request->input('total_price');
        $order->is_paid = false;
        $order->status = 'pending';
        if(auth()->user()->address_id != null){
            $order->address_id = auth()->user()->address_id;
                $payment = new Payment;
                $payment->user_id = auth()->user()->id;
                $payment->payment_type = 'cash';
                $payment->provider = 'cash';
                $payment->status = 'pending';
                $payment->save();
            $order->payment_id = $payment->id;
            $order->save();
            if($request->input('from_cart')=="on"){
                $cart_item = Cart_item::find($request->input('cart_id'));
                $cart_item->delete();
            }
        }
        return view('checkout.orderConfirmation')->with('order', $order)->with('payment', $payment)->with('request', $request);

    }
    // public function confirm(){
    //     return view('checkout.confirm')->with('order', $order);
    // }
}
