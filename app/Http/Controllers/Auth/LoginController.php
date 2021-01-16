<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestLogin;
class LoginController extends Controller
{
    public function getFormLogin(){
        return view('auth.login');
    }
    public function postLogin(RequestLogin $request){
        $data =$request->only('email','password');
        if(Auth::attempt($data)){
          
        return redirect()->to('/');
        }
        else{
            \Session::flash('toastr',[
                'type'=>'error',
                'messages'=>'Sai tài khoản hoặc mật khẩu'
            ]);
        }
        return redirect()->back();
    }
    protected function getLogout(){
        Auth::logout();
        return redirect()->route('get.login');
    }
}
