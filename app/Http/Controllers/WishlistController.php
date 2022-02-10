<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wish;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index () {
        $wishes = Wish::where('user_id', auth()->user()->id)->get();
        $products = [];
        foreach ($wishes as $wish){
            array_push($products, Product::find($wish->product_id));
        }
        if($wishes)
        return view('pages.wishlist')->with('wishes', $wishes)->with('products', $products);
        
        return('pages.wishlist')->with('error', 'No items in your wishlist');
    }
}
