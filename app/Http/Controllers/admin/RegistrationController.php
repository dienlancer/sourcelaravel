<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
class RegistrationController extends Controller
{
    public function register(){
    	return view('admin.register');
    }
    public function postRegister(Request $request){
    	$user=Sentinel::registerAndActivate($request->all());
    	return redirect('/');
    }
}
