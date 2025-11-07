<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id','desc')->get();

        return view('backend.admin.orders.index',compact('orders'));
    }

    public function invoice($id){

        $order = Order::where('id',$id)->first();
        $admin_data = Admin::where('id',1)->first();

        return view('backend.admin.orders.invoice',compact('order','admin_data'));
    }
}
