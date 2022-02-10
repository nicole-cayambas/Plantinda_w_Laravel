<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class PagesController extends Controller
{
    public function index(){
        $categories = Category::orderBy('parent_id', 'desc')->get();
        $products = Product::orderBy('created_at', 'desc')->paginate(30); //for pagination
        return view('pages.index')->with('products', $products)->with('categories', $categories);
    }
    public function wishlist(){
        $title = "Wishlist";
        return view('pages.wishlist')->with('title', $title);
    }
    public function orders(){
        return view('pages.orders');
    }
}
