<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Redirect;

class VerifyController extends Controller
{
    public function verifyForm($user_id)
    {
        return view('auth.verify')->with('user',$user_id);
    }
    public function verifyCode(Request $request)
    {
        $code = User::where('id',$request->userid)->value('verification_code');
        if($code==$request->code){
            $update = User::find($request->userid);
            $update->status = 1;
            $update->phone_verified_at = now();
            $update->verification_code ="";
            $update->save();
            session()->flash('success', 'You have successfully Registered with Our Service');
            return redirect('/login');
        }else{
            session()->flash('error', 'Invalid Code');
            return back();
        } 
    }
}
