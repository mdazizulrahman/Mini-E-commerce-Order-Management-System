<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class detailsController extends Controller
{
    public function details($id, $slug = null)
    {
        
         $product = Product::with('category')->findOrFail($id);
        return view('frontend.details', compact('product'));
    }
}
