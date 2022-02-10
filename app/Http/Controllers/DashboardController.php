<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        return view('dashboard.pages.orders');
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
