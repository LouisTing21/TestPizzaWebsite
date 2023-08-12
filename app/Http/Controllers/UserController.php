<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function index(){
        $pizza=Pizza::where('publish_status',1)->get();
        $category=Category::get();

        if(count($pizza)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        return view('user.home')->with(['pizza'=>$pizza,'category'=>$category,'status'=> $emptyStatus]);
    }

    public function pizzaSearch($id){
        $data=Pizza::where('category_id',$id)->get();
        $category=Category::get();
         if(count($data)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        return view('user.home')->with(['pizza'=>$data,'category'=>$category,'status'=> $emptyStatus]);
    }

    public function detials($id){
        $data=Pizza::where('pizza_id',$id)->first();
        Session::put('PIZZA_ORDER',$data);
        return view('user.detail')->with(['detial'=>$data]);
    }

    public function priceSearchPizza(Request $request){
        $validator = Validator::make($request->all(), [
            'startDate' => 'required',
            'endDate' => 'required',
            'min' => 'required',
            'max' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $start=$request->startDate;
        $end=$request->endDate;
        $min=$request->min;
        $max=$request->max;
        $query=Pizza::whereBetween('price',[$min,$max])

                    ->get();


         $query=Pizza::whereBetween('created_at',[$start,$end])

                    ->get();



        // if(is_null($min) and  !is_null($max)){

        //     $query=$query->where('price','>=',$min);
        // }elseif(!is_null($min) and is_null($max)){

        //     $query=$query->where('price','<=',$max);
        // }elseif(!is_null($min) and !is_null($max)){

        //     $query=$query->where('price','>=',$min)
        //                  ->where('price','<=',$max);
        // }


        // $query=$query->get();


        $category=Category::get();
       $status= count($query) == 0 ? 0 : 1;
        return view('user.home')->with(['pizza'=>$query,'category'=>$category,'status'=> $status]);
    }

    public function orderPage(){
       $pizzaInfo= Session::get('PIZZA_ORDER');
       return view('user.order')->with(['order'=>$pizzaInfo]);
    }

    public function placeOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'count' => 'required',
            'payment' => 'required',

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $pizzaInfo= Session::get('PIZZA_ORDER');
        $userId=auth()->user()->id;
        $count=$request->count;

        $orderData=$this->requestOrderData($pizzaInfo,$userId,$request);

        for($i=0;$i<$count;$i++){
            Order::create($orderData);
        }
        $total=$pizzaInfo['waiting_time']*$count;
        return back()->with(['total'=>$total]);
    }



    public function categorySearch(Request $request){

        $category=Category::get();

        $pizza=Pizza::orWhere('pizza_name','like','%'.$request->search.'%')
                    ->orWhere('price',$request->search)

                    ->get();

                    if(count($pizza)==0){
                        $emptyStatus=0;
                    }else{
                        $emptyStatus=1;
                    }
        return view('user.home')->with(['pizza'=>$pizza,'category'=>$category,'status'=> $emptyStatus]);
    }

    private function requestOrderData($pizzaInfo,$userId,$request){
        return[
            'customer_id'=>$userId,
            'pizza_id'=>$pizzaInfo['pizza_id'],
            'biker_id'=>0,
            'payment_status'=>$request->payment,
            'order_time'=>Carbon::now()
        ];
    }


}
