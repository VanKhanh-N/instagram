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
use App\Models\Follow; 
use App\Http\Requests\RequestRegister;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSuccess;
use App\Mail\Notification;
use Illuminate\Http\Request;
use App\SendCode;
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
    public function create(RequestRegister $request)
    { 
        $data =$request->except('_token');  
        $data['password']=Hash::make($data['password']);
        $data['created_at']=Carbon::now(); 
        
        if(is_numeric($request->email)){
            $data['phone'] =$data['email'];
            $data['code_otp']=SendCode::SendCode($data['email']); 
            $id =User::insertGetId($data);
            \Session::flash('toastr',[
                'type'=>'success',
                'messages'=>'Đăng ký thành công . Vui lòng nhập mã xác minh !'
            ]);
            return redirect()->route('user.verify.message');
        }
       
        else{
            $request->validate([
                'email'=>'email'
            ],[
                'email.email'=>'Email không đúng định dạng'
            ]);
            $id =User::insertGetId($data);
            \Session::flash('toastr',[
                'type'=>'success',
                'messages'=>'Đăng ký thành công . Vui lòng xác nhận tài khoản qua gmail !'
            ]);
            Mail::to($request->email)->send(new RegisterSuccess($request->c_name,$request->user));

           return redirect()->route('get.login');
        } 
        
        return redirect()->back();
    }

    public function getVerifyAccount($user){
        $user =User::where('user',$user)->first();
        Mail::to('shopsoda1pk@gmail.com')->send(new Notification($user->id,$user->c_name,$user->user));
        
        $user->is_active =1;
        $user->save();
       
        $user->save();
        Auth::loginUsingId($user->id, true);
        \Session::flash('toastr',[
            'type'=>'success',
            'messages'=>'Xác minh tài khoản thành công !'
        ]);
        return redirect()->to('/');
    }
    public function getVerifyMessage(){
        return view('layout.verify_phone');
    }
    public function postVerifyMessage(Request $request){
        $code=$request->a.$request->b.$request->c.$request->d.$request->e.$request->f;   
        $user =User::where('code_otp',$code)->first();
        if($user){
        Mail::to('shopsoda1pk@gmail.com')->send(new Notification($user->id,$user->c_name,$user->user));
        Auth::loginUsingId($user->id, true);
            $user->is_active=1;
            $user->code_otp='';
            $user->save();
            \Session::flash('toastr',[
                'type'=>'success',
                'messages'=>'Xác minh tài khoản thành công !'
            ]);
        return redirect()->to('/');
        }else{
            \Session::flash('toastr',[
            'type'=>'error',
            'messages'=>'Mã xác thực không đúng !'
        ]);
        return redirect()->back();

        }
    }
}
