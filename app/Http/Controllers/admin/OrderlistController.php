<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderlistController extends Controller
{
   
     
    public function index()
    {
        return view('admin.master_file.Order');
    }

    
}
