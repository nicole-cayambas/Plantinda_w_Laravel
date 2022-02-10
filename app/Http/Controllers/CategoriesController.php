<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index(){
        return DB::select('SELECT * FROM categories');
    }
}
