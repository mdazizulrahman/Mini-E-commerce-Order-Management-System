<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id=null){
        return view('admin.master_file.Product', compact('id'));
    }
}
