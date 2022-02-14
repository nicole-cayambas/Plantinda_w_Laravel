<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Store;

class DashboardController extends Controller
{
    public function index(){
        
        if(auth()->user()->user_type === 'buyer') {
            abort(403, 'Unauthorized action.');
        }
        return view('dashboard.pages.index');
    }
    public function products()
    {
        return view('dashboard.products.index');
    }
    public function orders()
    {
        $store = Store::where('seller_id', auth()->user()->id)->first();
        $orders = Order::where('store_id', auth()->user()->id)->get();
        return view('dashboard.pages.orders')->with('orders', $orders)->with('store', $store);
    }
    public function earnings()
    {
        return view('dashboard.pages.earnings');
    }
    public function store()
    {
        return view('dashboard.store.index');
    }
}
