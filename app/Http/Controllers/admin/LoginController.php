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
    	echo "<pre>".print_r(Sentinel::check(),true)."</pre>";
    }
}
