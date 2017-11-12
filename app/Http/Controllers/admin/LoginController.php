<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
class LoginController extends Controller
{
    public function login(){
    	return view('admin.login');
    }
    public function postLogin(Request $request){    	
    	Sentinel::authenticate($request->all());
    	if(Sentinel::check()){
    		return redirect()->route('admin.category-article.getList');
    	} else{
    		return redirect()->route('admin.login');	
    	}    	
    }
    public function logout(){
    	Sentinel::logout();
    	return redirect()->route('admin.login');
    }
}
