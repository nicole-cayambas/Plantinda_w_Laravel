<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at', 'desc')->paginate(30); //for pagination
        return view('pages.index')->with('products', $products);
    }
    public function wishlist(){
        $title = "Wishlist";
        return view('pages.wishlist')->with('title', $title);
    }
    public function orders(){
        return view('pages.orders');
    }
    public function profile(){
        return view('pages.profile');
    }
    public function cart(){
        $data = array(
            'title'=>'cart',
            'services'=>['Seed', 'Soil', 'Tools']
        );
        return view('pages.cart')->with($data);
    }
}
