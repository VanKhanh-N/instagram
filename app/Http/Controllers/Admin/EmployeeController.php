<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Role;
use Carbon\Carbon;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Log;
class EmployeeController extends Controller
{
     public function index()
    {
        $admin= Admin::paginate(15);
        $viewData=[
            'admin' =>$admin,
            'title' =>'Người dùng',
        ];
        return view('admin.employee.index',$viewData);
    }
    public function create()
    { 
        $role =Role::all();
        $viewData=[
        'role'  =>$role,
        'title' =>'Thêm người dùng',
    ];
        return view('admin.employee.create',$viewData);
    }
    public function store(Request $request)
    {
            $request->validate([
            'email'=>'email|required',
            'name' =>'required',
            'password' =>'min:6',
            'roles'    =>'required'
        ],[
            'email.required'=>'Bạn cần nhập email',
            'email.email'=>'Email không đúng định dạng',
            'name.required'=>'Bạn cần nhập tên người dùng',
            'password.min'=>'Mật khẩu cần nhiều hơn 6 kí tự',
            'roles.required'=>'Bạn cần chọn vai trò của người dùng',
        ]);
        try{ 
            DB::beginTransaction();
            $user=Admin::create([
                'name' =>$request->name,
                'email'=>$request->email,
                'password' =>Hash::make($request->password) 
            ]); 
            $user->roles()->attach($request->roles);
            DB::commit();
        return redirect()->route('admin.employee.index');
    }catch(\Exception $e){
            DB::rollBack();
            Log::error('Lỗi :'.$e->getMessage().' tại dòng '.$e->getLine());
        }
    }
    public function edit($id)
    {  
        $admin=Admin::find($id);
        $role=Role::all();
        $role_admin =DB::table('role_user')->where('user_id',$id)->select('role_id')->get(); 
        $viewData=[
        'admin'  =>$admin,
        'role_admin'  =>$role_admin,
        'role'   =>$role,
        'title' =>'Thay đổi người dùng',
    ];
        return view('admin.employee.update',$viewData);
    }
    public function update(Request $request,$id)
    {
       $request->validate([
            'email'=>'email|required',
            'name' =>'required',
            'password' =>'min:6',
            'roles'    =>'required'
        ],[
            'email.required'=>'Bạn cần nhập email',
            'email.email'=>'Email không đúng định dạng',
            'name.required'=>'Bạn cần nhập tên người dùng',
            'password.min'=>'Mật khẩu cần nhiều hơn 6 kí tự',
            'roles.required'=>'Bạn cần chọn vai trò của người dùng',
        ]);
        try{ 
            DB::beginTransaction();
            $admin=Admin::find($id);
            $admin->update([
                'name' =>$request->name,
                'email'=>$request->email,
                'password' =>Hash::make($request->password) 
            ]); 
            $admin->roles()->sync($request->roles);
            DB::commit();
        return redirect()->route('admin.employee.index');
    }catch(\Exception $e){
            DB::rollBack();
            Log::error('Lỗi :'.$e->getMessage().' tại dòng '.$e->getLine());
        }
    }
    public function delete($id)
    {
        try{ 
            DB::beginTransaction();
            $admin=Admin::find($id)->delete(); 
            $admin->update([
                'name' =>$request->name,
                'email'=>$request->email,
                'password' =>Hash::make($request->password) 
            ]); 
            $admin->roles()->sync($request->roles);
            DB::commit();
        return redirect()->back();
    }catch(\Exception $e){
            DB::rollBack();
            Log::error('Lỗi :'.$e->getMessage().' tại dòng '.$e->getLine());
        }
    }
}
