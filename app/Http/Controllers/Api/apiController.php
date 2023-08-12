<?php

namespace App\Http\Controllers\Api;

use Response;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class apiController extends Controller
{
    //
    public function categoryList(){
        $category=Category::get();
        $data=[
            'status'=>'success',
            'category'=>$category
        ];
        return Response::json($data);
    }

    public function categoryCreate(Request $request){
       $data=[
           'category_name'=>$request->name,
           'created_at'=>Carbon::now(),
           'updated_at'=>Carbon::now()
       ];

       Category::create($data);

       return Response::json([
            'status'=>200,
            'category'=>'success'
       ]);

    }

    public function categoryDetail($id){


        $data=Category::where('category_id',$id)->first();

        if(!empty($data)){

       return Response::json([
        'status'=>200,
        'category'=>'success',
        'data'=>$data
          ]);
        }
        return Response::json([
            'status'=>200,


              ]);
    }

    public function delete($id){
        $data=Category::where('category_id',$id)->first();

        if(empty($data)){
            return Response::json([
                'status'=>200,
                'message'=>'There is no data.',

                  ]);
        }

        Category::where('category_id',$id)->delete();

        return Response::json([
            'status'=>200,
            'mseesge'=>'Delete Success',

        ]);

    }

    public function update(Request $request){
        $updateData=[
            'category_id'=>$request->id,
            'category_name'=>$request->categoryName
        ];

        $chack=Category::where('category_id',$request->id)->first();

        if(!empty($chack)){
            Category::where('category_id',$request->id)->update($updateData);
            return Response::json([

                'status'=>100,
                'message'=>'success',

            ]);
        }
        return Response::json([

            'status'=>1000,
            'message'=>'fail',

        ]);
    }

    public function search(Request $request){
        $data=Category::orWhere('category_name','like','%'.$request->search.'%')
                       ->orWhere('category_id','like','%'.$request->search.'%')
                        ->get();


        if(!empty($data)){
            return Response::json([
                'status'=>300,
                 'data'=>$data
            ]);
        }
        return Response::json([
            'status'=>3000,
            'message'=>'There is no data'
        ]);
    }
}
