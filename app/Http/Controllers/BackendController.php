<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrders;

class BackendController extends Controller
{
    public function getOrders(){
        $customerOrders  = new CustomerOrders();
        $customerOrders->all();
        return view('backend.index', compact('customerOrders'));
    }
}
