<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //userList
    public function userList(){
        $data=User::where('role','user')->paginate(6);

        return view('admin.user.userList')->with(['user'=>$data]);
    }

    //adminlist
    public function adminList(){
        $data=User::where('role','admin')->paginate(6);

        return view('admin.user.adminList')->with(['admin'=>$data]);

    }

    public function userSearch(Request $request){
        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $response=$this->search('user',$request);

        return view('admin.user.userList')->with(['user'=>$response]);
    }


    public function adminSearch(Request $request){
        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $response=$this->search('admin',$request);

        return view('admin.user.adminList')->with(['admin'=>$response]);
    }

    public function search($role,$request){
        $data=User::where('role',$role)
                    ->where(function($query) use($request) {
                        $query->orWhere('name','like','%'.$request->search.'%')
                                ->orWhere('phone','like','%'.$request->search.'%')
                                ->orWhere('email','like','%'.$request->search.'%')
                                ->orWhere('address','like','%'.$request->search.'%');
                    })


                    ->paginate(6);

        $data->appends($request->all());

        return $data;
    }

    public function userDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Deleted...']);
    }

    public function adminDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Deleted...']);
    }


}
