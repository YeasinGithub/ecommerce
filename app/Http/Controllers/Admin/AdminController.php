<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Hash;

class AdminController extends Controller
{
    public function index(){
    	return view('admin.home');
    }

    public function profile(){
    	return view('admin.profile.index');
    }
    public function profileUpdate(Request $request){
    	$request->validate([
    		'name'=>'required',
    		'email'=>'required',
    		'phone'=>'required',
    	],[

    		'name.required'=>'input your name',
    	]);

    	User::findOrFail(Auth::id())->update([
    		'name'=> $request->name,
    		'email'=> $request->email,
    		'phone'=> $request->phone,
    		'updated_at'=>Carbon::now(),
    	]);
    	$notification=array(
			'message'=>'Your profile Updated',
			'alert-type'=>'success'
		);
		return Redirect()->back()->with($notification);
    }
    /*----------admin image update-------------*/
    public function updateImgPage(){
    	return view('admin.profile.image_change');
    }
    public function updateImg(Request $request){
    	$old_image = $request->old_image;

            if (User::findOrFail(Auth::id())->image == 'fontend/media/laptopAvatar.jpg') {
                $image = $request->file('image');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('fontend/media/'.$name_gen);
                $save_url = 'fontend/media/'.$name_gen;
                User::findOrFail(Auth::id())->Update([
                    'image' => $save_url
                ]);
                $notification=array(
                    'message'=>'Image Successfully Updated',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);

            }else {
                unlink($old_image);
                $image = $request->file('image');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('fontend/media/'.$name_gen);
                $save_url = 'fontend/media/'.$name_gen;
                User::findOrFail(Auth::id())->Update([
                    'image' => $save_url
                ]);
                $notification=array(
                    'message'=>'Image Successfully Updated',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
            }
    	}
    	public function updatePass(){
    		return view('admin.profile.password_change');
    	}
    	public function updatePassStore(Request $request){
    		$request->validate([
   			'old_password' => 'required',
   			'new_password' => 'required|min:8',
   			'confirm_password' => 'required|min:8',
   		]);

   		$db_pass = Auth::user()->password;
   		$old_password = $request->old_password;
   		$new_password = $request->new_password;
   		$confirm_password = $request->confirm_password;

   		if (Hash::check($old_password,$db_pass)) {

   			if ($new_password === $confirm_password) {

   				User::findOrFail(Auth::id())->update([
   					'password' => Hash::make($new_password)
   				]);
   				Auth::logout();
   				$notification=array(
                    'message'=>'Successfully password Change! Now login By New Password',
                    'alert-type'=>'success'
                );
   				return Redirect()->route('login')->with($notification);

   			}else{
   				$notification=array(
                    'message'=>'New password and confirm password Not Same',
                    'alert-type'=>'error'
                );
   			return Redirect()->back()->with($notification);
   			}
   			
   		}else{
   			$notification=array(
                    'message'=>'Old password Not Match',
                    'alert-type'=>'error'
                );
   			return Redirect()->back()->with($notification);
   		}
    	}
}
