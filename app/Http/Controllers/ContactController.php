<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function contactCreate(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
       $data=$this->contactUserData($request);
        Contact::create($data);

        return back()->with(['contactSuccess'=>'Message Sent!']);
    }

    public function contactSearch(Request $request){


        $data=Contact::orWhere('name','like','%'.$request->search.'%')
                    ->orWhere('eamil','like','%'.$request->search.'%')
                    ->orWhere('message','like','%'.$request->search.'%')

                    ->paginate(6);

        $data->appends($request->all());
        if(count($data)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        return view('admin.contact.list')->with(['contact'=>$data,'status'=>$emptyStatus]);
    }



    public function contact(){

        $data=Contact::orderBy('contacct_id','desc')->get();
        if(count($data)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        return view('admin.contact.list')->with(['contact'=>$data,'status'=>$emptyStatus]);
    }

    private function contactUserData($request){
        return[
            'user_id'=>auth()->user()->id,
            'name'=>$request->name,
            'eamil'=>$request->email,
            'message'=>$request->message,
        ];
    }
}
