<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
class RegistrationController extends Controller
{
    public function register(){
    	return view('authentication.register');
    }
    public function postRegister(Request $request){
    	dd($request->all());
    }
}
