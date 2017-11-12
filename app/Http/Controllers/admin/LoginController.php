<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
class LoginController extends Controller
{
    public function login(){
        if(Sentinel::check()){
            return redirect()->route('admin.category-article.getList');  
        }else{
            return view('admin.login');
        }    	
    }
    public function postLogin(Request $request){    	
    	Sentinel::authenticate($request->all());
    	if(Sentinel::check()){
            $status=Sentinel::getUser()->status;
            if($status==1){
                return redirect()->route('admin.category-article.getList');  
            }else{
                return redirect()->route('admin.login');    
            }            
        }else{
            return redirect()->route('admin.login');    
        }    	
    }
    public function logout(){
         Sentinel::logout();
         return redirect()->route('admin.login');
    }
}
