<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart_item;

class CartController extends Controller
{
    public function index () {
        $cart_items = Cart_item::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(30);
        return view('pages.cart')->with('cart_items', $cart_items);
    }
    public function destroy($id){
        $cart_item = Cart_item::where('user_id', auth()->user()->id)->where('product_id', $id)->first();
        $cart_item->delete();
        return redirect()->back()->with('success', 'Item Removed');
    }
}
