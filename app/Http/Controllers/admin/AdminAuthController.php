<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;
class AdminAuthController extends Controller
{
   
    public function login()
    {
        return View('admin.login');
    }
     public function dologin()
    {
    	$remmber=Request('rememberme')==1 ? true:false;
        if(Auth()->guard('admin')->attempt(['email'=>Request('email'),'password'=>Request('password')],$remmber)){
           return redirect('admin');
        }else{
        	session()->flash('error','inccorrect');
        	return redirect('/admin/login');
        }
    }
    public function logout(){
      Auth()->guard('admin')->logout(); 
      return redirect('/admin/login');
    }

    public function admins(){
       return Admin::latest()->paginate(10);
    }

   
}
