<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart_item;

class ProductsController extends Controller
{

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show')->with('product', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $categories = Category::orderBy('parent_id', 'desc')->get();
        $products = Product::where('name', 'like', "%{$request->input('search')}%")->orderBy('created_at', 'desc')->paginate(30);
        return view('pages.search_results')->with('products', $products)->with('categories', $categories);
    }
    
    public function applyFilter(Request $request){
        $categories = Category::orderBy('parent_id', 'desc')->get();
        $products = Product::where('rating', (int)$request->input('rating'))->orderBy('created_at', 'desc')->paginate(30);
        // $products = Product::where('unit_price_1', '<', (int)$request->input('price'))->orderBy('created_at', 'desc')->paginate(30);
        // dd($products);
        return view('pages.filter_results')->with('products', $products)->with('categories', $categories);
    }
}
