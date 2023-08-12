<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //

    public function index(){
        return view('admin.home');
    }

    public function addCategory(){
        return view('admin.category.addCategory');
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data=[
            'category_name'=>$request->name
        ];
        Category::create($data);
        return redirect()->route('admin#category')->with(['categorySuccess'=>'Category Success...']);
    }

    public function delete($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category deleted...']);
    }

    public function edit($id){
        $data=Category::where('category_id',$id)->first();
        return view('admin.category.update')->with(['category'=>$data]);
    }

    public function csvDownload(){

        if(Session::has('CATEGORY_DATA')){
            $category=category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                        ->leftJoin('pizzas','categories.category_id','pizzas.category_id')
                        ->where('category_name','like','%'.Session::get('CATEGORY_DATA').'%')
                        ->groupBy('categories.category_id')
                        ->get();
        }else{
            $category=category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
            ->leftJoin('pizzas','categories.category_id','pizzas.category_id')
            ->groupBy('categories.category_id')
            ->get();
        }


        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($category, [
            'category_id' => 'ID',
            'category_name' => 'Name',
            'count'=>'Pizza Count',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date',

        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'categorylist.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');

    }

    public function update($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $updateData=[
            'category_name'=>$request->name,

        ];
        $updateData['id']=$id;
        // Category::where('category_id',$request->id)->update($updateData);

        // return redirect()->route('admin#confirmCategory')->with(['updateSuccess'=>'Category updated...'])
        Session::put('CATEGORY_DATA',$updateData);

        // return view('admin.category.confirm')->with(['category'=>$updateData]);
        return redirect()->route('admin#confirmCategory');
    }

    public function real(){
        $data=Session::get('CATEGORY_DATA');
        $id=$data['id'];
        unset($data['id']);

        Category::where('category_id',$id)->update($data);
        return redirect()->route('admin#category')->with(['updateSuccess'=>'Categroy updated...']);

    }

    public function confirm(){
        $data=Session::get('CATEGORY_DATA');
        return view('admin.category.confirm')->with(['category'=>$data]);
    }



    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data=category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                        ->leftJoin('pizzas','categories.category_id','pizzas.category_id')
                        ->where('category_name','like','%'.$request->search.'%')
                        ->groupBy('categories.category_id')
                        ->paginate(6);

        $data->appends($request->all());

        Session::put('CATEGORY_DATA',$request->search);
        return view('admin.category.list')->with(['Category'=>$data]);

    }
    public function categoryItem($id){
        $data=Pizza::select('pizzas.*','categories.category_name as CategoryName')
                    ->join('categories','categories.category_id','pizzas.category_id')
                    ->where('categories.category_id',$id)
                    ->paginate(5);


        return view('admin.category.item')->with(['pizza'=>$data]);
    }

    public function category(){
        if(Session::has('CATEGORY_DATA')){
            Session::forget('CATEGORY_DATA');
        }
        $data=category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                       ->leftJoin('pizzas','categories.category_id','pizzas.category_id')
                       ->groupBy('categories.category_id')
                       ->paginate(6);


        return view('admin.category.list')->with(['Category'=>$data]);
    }




}
