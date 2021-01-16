<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\RequestLogin;
class ResetPasswordController extends Controller
{
   public function getFormPassword(){
       return view('auth.forgot-password');
   }
   public function postPassword(RequestLogin $request){
    
}
}
