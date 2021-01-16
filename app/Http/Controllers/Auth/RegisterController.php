<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Requests\RequestRegister;
class RegisterController extends Controller
{ 

    use RegistersUsers;
 
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    public function getFormRegister(){ 
        return view('auth.register');
    }
    protected function create(RequestRegister $request)
    {
        $data =$request->except('_token'); 
        $data['password']=Hash::make($data['password']);
        $data['created_at']=Carbon::now();
        $id =User::insertGetId($data);
        if($id){
            \Session::flash('toastr',[
                'type'=>'success',
                'messages'=>'Đăng ký thành công'
            ]);
            return redirect()->route('get.login');
        }
        return redirect()->back();
    }
}
