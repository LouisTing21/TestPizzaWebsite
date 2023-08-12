<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function order(){
        $data=Order::select('orders.*','pizzas.pizza_name','users.name',DB::raw('COUNT(orders.pizza_id) as count'))
             ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
             ->join('users','users.id','orders.customer_id')
             ->groupBy('orders.customer_id','orders.pizza_id')
             ->paginate(6);


        return view('admin.order.list')->with(['order'=>$data]);
    }

    public function orderSearch(Request $request){
        $data=Order::select('orders.*','pizzas.pizza_name','users.name',DB::raw('COUNT(orders.pizza_id) as count'))
        ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
        ->orWhere('users.id','like','%'.$request->search.'%')
        ->orWhere('users.name','like','%'.$request->search.'%')
        ->orWhere('pizzas.pizza_name','like','%'.$request->search.'%')
        ->join('users','users.id','orders.customer_id')
        ->groupBy('orders.customer_id','orders.pizza_id')
        ->paginate(6);


   return view('admin.order.list')->with(['order'=>$data]);
    }
}
