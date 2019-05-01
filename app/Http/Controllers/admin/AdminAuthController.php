<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;
use Session;
class AdminAuthController extends Controller
{
   
    public function login()
    {
        return View('admin.login');
    }
     public function dologin()
    {
        //return Request()->all();
    	$remmber = Request('rememberme');
        if(Auth()->guard('admin')->attempt(['email'=>Request('email'),'password'=>Request('password')],$remmber)){
            //session()->forget('logout','dfgdfgg');
            $admin = Admin::where('email', '=', Request()->email)->get();
            // return redirect('admin/dashbord');
            return response()->json(['data' => $admin, 'login' => 'true'], 200);
        }else{
        	//session()->flash('error','inccorrect');
            // return redirect('/admin/login');
           return response()->json(['login' => 'no']);
           //return ['fsdf', 'dsgqsgf'];
        }
       
       
    }
    public function logout(){
        Auth()->guard('admin')->logout();
        return response()->json(['data' => 'logout']);
      
    }

    public function admins(){
       return Admin::latest()->paginate(10);
    }

   
}
