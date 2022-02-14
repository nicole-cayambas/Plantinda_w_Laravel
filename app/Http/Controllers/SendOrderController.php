<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart_item;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Address;
use App\Models\Wish;

class SendOrderController extends Controller
{
    protected function buy(){

    }
    public function store(Request $request) {
        // dd($request->all());
        if(!$request->input('cart_id')){ //if not from cart
            $price = explode("-", $request->input('price'));
            $whichPrice = $price[1];
            $request->merge(['price' => (double)$price[0]]);
            
            $max_quant = function($request, $whichPrice){
                $product = Product::find($request->input('product_id'));
                return $product->{'range_'.$whichPrice.'_max'};
            };
            $min_quant = function($request, $whichPrice){
                $product = Product::find($request->input('product_id'));
                return $product->{'range_'.$whichPrice.'_min'};
            };
            $min_quant = $min_quant($request, $whichPrice);
            $max_quant = $max_quant($request, $whichPrice);
            $zero = 0;

            $this->validate($request, [
                'quantity' => "numeric|between:$min_quant,$max_quant"
            ]);
        } 
        if($request->submit === 'addToCart'){
            $cart_item = new Cart_item;
            $cart_item->product_id = $request->input('product_id');
            $cart_item->user_id = auth()->user()->id;
            $cart_item->store_id = 1;
            $cart_item->quantity = (int)$request->input('quantity');
            $cart_item->unit_price = $request->input('price');
            $cart_item->shipping_price = (double)50;
            $cart_item->total_price = $request->input('price') * (int)$request->input('quantity') + 50;
            $cart_item->save();
            return redirect()->back()->with('success', 'Added To Cart');
        } 
        
        else if($request->submit === 'sendOrder'){
            $address = Address::find(auth()->user()->address_id);
            // dd($request->all());
            return view('checkout.index')->with('address', $address)->with('request', $request);
        } 
        
        else if($request->submit === 'wishlist') {
            $wishExist = Wish::where('user_id', auth()->user()->id)->where('product_id', $request->input('product_id'))->first();
            if(!$wishExist){
                $wish = new Wish;
                $wish->product_id = $request->input('product_id');
                $wish->user_id = auth()->user()->id;
                $wish->save();
                return redirect()->back()->with('success', 'Added to Wishlist');
            } 
            else {
                $wishExist->delete();
                return redirect()->back()->with('success', 'Removed from Wishlist');
            }
        }
    }
}