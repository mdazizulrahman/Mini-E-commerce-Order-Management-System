<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class indexController extends Controller
{
       
    public function index(){
        $products = Product::latest()->take(12)->get();
        return view('frontend.index', compact('products'));
    }
}
