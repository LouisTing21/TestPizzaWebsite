<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function profile(){
        $id=auth()->user()->id;
        $userData=User::where('id',$id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }



    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    public function updateProfile($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data=$this->updateData($request);
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Profile Updated...']);
    }

    public function changePassword($id, Request $request){
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword'=>'required',
            'confirmPassword'=>'required',

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $data=User::where('id',$id)->first();


        $oldPassword=$request->oldPassword;
        $newPassword=$request->newPassword;
        $confirmPassword=$request->confirmPassword;
        $hashedPassword=$data['password'];

        if (Hash::check($oldPassword, $hashedPassword)) {
           if($newPassword!=$confirmPassword){
            return back()->with(['notSameError'=>'Password Confirmation Do Not Match...']);
           }else{
                if(strlen($newPassword) <= 6 && strlen($confirmPassword)<=6){
                    return back()->with(['lenghtError'=>'Password must be greater than 6...']);
                }else{


                    $hash=Hash::make($newPassword);

                    User::where('id',$id)
                        ->update(['password'=>$hash]);

                        return back()->with(['success'=>'Password Change...']);
                }
           }
        }else{
            return back()->with(['notMatchError'=>'Password Do Not Match . Try again!']);
        }

    }

    public function updateAdminList($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data=$this->updateData($request);
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Admin  Updated...']);
    }

    public function editAdminList($id){

        $adminData=User::where('id',$id)->first();

        return view('admin.user.editAdminList')->with(['admin'=>$adminData]);
    }

    public function updateUserList($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data=$this->updateData($request);
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'User  Updated...']);
    }

    public function editUserList($id){

        $userData=User::where('id',$id)->first();

        return view('admin.user.editUserList')->with(['user'=>$userData]);
    }



    // private function requestPasswordData($request){
    //     return[
    //         'old'
    //     ]
    // }

    private function updateData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
    }
}
