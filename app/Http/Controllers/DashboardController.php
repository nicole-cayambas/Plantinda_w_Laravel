<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        
        if(auth()->user()->user_type === 'buyer') {
            abort(403, 'Unauthorized action.');
        }
        return view('dashboard.pages.index');
    }
}
